/*
    Hiding and showing meta data on the video index page.
*/
$(function()
{
    $('div.video div.meta p:not(.date)').hide();
    
    $('div.video').hover(function()
    {
        $(this).find('div.meta p').fadeIn(1000);
    },function()
    {
        $(this).find('div.meta p:not(.date)').fadeOut(1000);
    });
});