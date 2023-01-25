function ChangeVideo(e,video_id,video_title) {
    $('#main-title-heading').html(video_title);
    $('.video-card-container').each(function(index,thisobj){
        $(thisobj).css('backgroundColor','white');
    })
    var child = e.children();
    child.css('backgroundColor','#f3f2f2');
    $('#current-video-iframe').attr('src',"https://www.youtube.com/embed/"+video_id+"?rel=0");
}

// $('.carousel').carousel({
//     interval:false,
//     wrap:false 
// })