(function() {
    'use strict';

    var COMMENTS_PREVIEW_LIMIT = 5;
    var EVENT_EDIT_ACTIVATE = 'commentEditActivate';

    var updater = updaterFabric();

    angular.module('comments', [])
        .directive('comments', function(apiService, userService, helper, alerts, userGroups, $q) {
            return {
                restrict: 'E',
                scope: {
                    postId: '@',
                    feedType: '@',
                    feedTypeId: '@',
                    count: '=?'
                },
                templateUrl: '/app/components/comments/comments.html',
                link: function($scope) {
                    var
                        currentUser = userService.getInfo();

                    $scope.isShowAll = false;
                    $scope.commentsPreviewLimits = COMMENTS_PREVIEW_LIMIT;
                    $scope.newComment = {
                        comment_id: 0,
                        post_time: '',
                        text: '',
                        user: currentUser
                    };

                    $scope.list = [];
                    $scope.limit = COMMENTS_PREVIEW_LIMIT;




                    $scope.toggleEdit = function(id) {
                        $scope.$broadcast(EVENT_EDIT_ACTIVATE, id);
                    };



                    $scope.addNew = function() {
                        return $q(function(resolve) {
                            apiService.comments.add($scope.feedType, $scope.feedTypeId, $scope.postId, $scope.newComment.text).then(
                                function(result) {
                                    var
                                        time = new Date();

                                    $scope.list.push({
                                        comment_id: result.comment_id,
                                        post_time: time.toISOString(),
                                        text: $scope.newComment.text,
                                        user: $scope.newComment.user
                                    });
                                    $scope.newComment.comment_id = 0;
                                    $scope.newComment.text = '';
                                    loadComments();
                                    resolve(false);
                                }
                            );
                        });

                    };

                    $scope.delete = function(commentId) {
                        alerts.confirm("Are you sure you want to delete this comment?").then(function() {
                            var indexInList = helper.findById($scope.list, 'comment_id', commentId);
                            if (indexInList < 0) {
                                return;
                            }
                            apiService.comments.delete($scope.feedType, $scope.feedTypeId, commentId) // feedType, objectId, commentId
                                .then(
                                    function() {
                                        $scope.list.splice(indexInList, 1);

                                    }
                                );
                        }, function() {});
                    };


                    $scope.toggleShowAll = function() {
                        $scope.isShowAll = !$scope.isShowAll;
                        if ($scope.isShowAll) {
                            $scope.limit = $scope.list.length;
                        } else {
                            $scope.limit = COMMENTS_PREVIEW_LIMIT;
                        }
                    };
                    $scope.$on('$destroy', updater.destroy);

                    $scope.canEdit = function(userId) {
                        return userId == currentUser.id;
                    };
                    $scope.canDelete = function() {
                        return currentUser.group_id != userGroups.student;
                    };

                    if (!$scope.postId) {
                        $scope.$watch('postId', function(val) {
                            if (val) {
                                updater.startPending(loadComments);
                            }
                        });
                    } else {
                        updater.startPending(loadComments);
                    }



                    function loadComments() {
                        apiService.comments.get($scope.feedType, $scope.feedTypeId, $scope.postId).then(
                            function(response) {
                                if (angular.isArray(response)) {
                                    $scope.list = response.reverse();
                                    $scope.count = $scope.list.length;
                                    angular.forEach($scope.list, function(item) {
                                        item.text = decodeEntities(item.text);
                                    });
                                    if ($scope.isShowAll) {
                                        $scope.showAll();
                                    }
                                }
                            }
                        );
                    }

                    var textArea = window.document.createElement('textarea');

                    function decodeEntities(encodedString) {
                        textArea.innerHTML = encodedString;
                        return textArea.value;
                    }

                }
            };
        })
        .directive('newCommentForm', function(apiService) {
            return {
                restrict: 'E',
                scope: {
                    comment: '=',
                    onActivate: '&',
                    onAdd: '&'
                },
                templateUrl: '/app/components/comments/newCommentForm.html',
                link: function($scope, element, attrs) {
                    var
                        $textarea = element.find('textarea'),
                        isVisible = false,
                        // CLASS_ACTIVE = 'active',
                        textBeforeEdit = '';

                    $scope.showNewComment = false;
                    if (attrs.onAdd) {
                        $scope.showNewComment = true;
                    }

                    $scope.$on(EVENT_EDIT_ACTIVATE, function(event, showId) {
                        if ($scope.comment.comment_id === showId) {
                            toggleVisible();
                        } else {
                            if (isVisible) {
                                isVisible = false;
                                $scope.showNewComment = false;
                            }
                        }
                    });


                    if ($scope.comment && !$scope.comment.comment_id) {
                        $textarea.on('focus', onFocus);
                        $scope.$on('$destroy', function() {
                            $textarea.off('focus', onFocus);
                        });
                    }
                    $scope.messageLoaderActive = false;
                    $scope.postComment = function() {
                        if (!$scope.messageLoaderActive) { // second function call locked
                            if ($scope.comment.comment_id) { // edit mode
                                $scope.messageLoaderActive = true;
                                saveEdit();
                            } else { // add new mode
                                if (typeof $scope.onAdd === 'function' && $scope.comment.text) {
                                    $scope.messageLoaderActive = true;
                                    $scope.onAdd().then(function() {
                                        $scope.messageLoaderActive = false;
                                    });
                                }
                            }
                        } else {}
                    };

                    function saveEdit() {
                        if ($scope.comment.text.length) {
                            apiService.comments.edit($scope.feedType, $scope.feedTypeId, $scope.comment.comment_id, $scope.comment.text)
                                .then( // feedType, objectId, commentId, text
                                    function() {
                                        $scope.messageLoaderActive = false;
                                        toggleVisible();
                                    }
                                );
                        } else {
                            $scope.comment.text = textBeforeEdit;
                            toggleVisible();
                        }
                    }

                    function onFocus() {
                        if (typeof $scope.onActivate === 'function') {
                            updater.queryUpdate();
                        }
                    }

                    function toggleVisible() {
                        if (isVisible) {
                            isVisible = false;
                            // element.removeClass(CLASS_ACTIVE);
                            $scope.showNewComment = false;
                        } else {
                            isVisible = true;
                            // element.addClass(CLASS_ACTIVE);
                            $scope.showNewComment = true;
                            $textarea.focus();
                            textBeforeEdit = $scope.comment.text;
                        }

                    }
                }
            };
        });

    function updaterFabric() {
        var UPDATE_PERIOD = 100; // in seconds
        var MINIMAL_PENDING_PERIOD = 20; // in seconds
        var
            lastUpdateTime,
            hTimeout,
            updatingCallback;


        var Updater = {
            queryUpdate: function() {
                if ((Date.now() - lastUpdateTime) > (MINIMAL_PENDING_PERIOD * 1000)) {
                    onTimeout();
                }
            },
            startPending: function(callback) {
                updatingCallback = callback;
                onTimeout();
            },
            destroy: function() {
                if (hTimeout) {
                    window.clearTimeout(hTimeout);
                }
            }
        };

        function onTimeout() {
            lastUpdateTime = Date.now();
            updatingCallback();
            resetTimer();
        }

        function resetTimer() {
            if (hTimeout) {
                window.clearTimeout(hTimeout);
            }
            hTimeout = window.setTimeout(onTimeout, UPDATE_PERIOD * 1000);
        }

        return Updater;
    }


})();
