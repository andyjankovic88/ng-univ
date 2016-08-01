function process_likes(post_id,post_type,element_id){

  if($("#"+element_id).hasClass('like-box')){
    vote_type = 'down'; 
  }else{
    vote_type = 'up';
  }
    $.ajax({
        type: 'post',
        url: base_url+'feed_posts/vote/'+post_type+'/'+post_id,
        data: {vote_type:vote_type},
        success: function(response){
          if(!isNaN(response))
          {
            $('#icon-thumbsup-'+post_id).html(response);
            
            if($("#"+element_id).hasClass('like-box')){
              $("#"+element_id).removeClass('like-box');
              $("#"+element_id).addClass('like-default');
            }else{
              $("#"+element_id).removeClass('like-default');
              $("#"+element_id).addClass('like-box');
            }

          }
        }
    });
  

  return;
}

function process_likes_ans(post_id,post_type,element_id){
  if($("#"+element_id).hasClass('like-box')){
    vote_type = 'down'; 
  }else{
    vote_type = 'up';
  }
    $.ajax({
        type: 'post',
        url: base_url+'feed_posts/vote/'+post_type+'/'+post_id,
        data: {vote_type:vote_type},
        success: function(response){
          if(!isNaN(response))
          {
            $('#icon-thumbsup-ans-'+post_id).html(response);
            
            if($("#"+element_id).hasClass('like-box')){
              $("#"+element_id).removeClass('like-box');
              $("#"+element_id).addClass('like-default');
            }else{
              $("#"+element_id).removeClass('like-default');
              $("#"+element_id).addClass('like-box');
            }

          }
        }
    });
  

  return;
}
