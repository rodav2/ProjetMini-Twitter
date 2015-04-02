$(document).ready(function(){
  var limitnum = 140; // set your int limit for max number of characters

Read more at http://spyrestudios.com/building-a-live-textarea-character-count-limit-with-css3-and-jquery/#VGAEcG5ADlhhfthf.99

function limits(obj, limit) { var cnt = $("#counter > span"); var txt = $(obj).val(); var len = txt.length; // check if the current length is over the limit if(len > limit){ $(obj).val(txt.substr(0,limit)); $(cnt).html(len-1); } else { $(cnt).html(len); } // check if user has less than 20 chars left if(limit-len <= 20) { $(cnt).addClass("warning"); } }
Read more at http://spyrestudios.com/building-a-live-textarea-character-count-limit-with-css3-and-jquery/#VGAEcG5ADlhhfthf.99


$('textarea').keyup(function(){
  limits($(this), limitnum);
});