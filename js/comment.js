// JavaScript Document
function append_comment(div_id,row,login_id){
	if(row.action == "delete"){
		$("#reply_"+row.pcom_id).fadeOut(300);
		return false;
	}
	//alert(print_r(row));
	var html = '<div id="reply_' + row.pcom_id + '" class="parent_' + row.pcom_id + ' parent">';
			html += '<div class="break_module_line"></div>';
			html += '<div class="parent_picture"><img src="/images/no_avatar.jpg"  border="0" /></div>';
			html += '<div class="parent_data">';
			html += '<span class="bold xanh">';
			html += '<img src="/images/icon_comment.gif" border="0" /> ' + htmlspecialbo(row.use_login) + ' ';
			html += '</span>';
			html += htmlspecialbo(row.pcom_teaser);
			html += '<div class="parent_date">';
			html += 'Cập nhật: ' + htmlspecialbo(row.pcom_date) + ' &nbsp;';
			html += '<a href="#">Bình luận</a> &nbsp;';
			html += '<a href="#">Thích</a> &nbsp;';
			html += '<a href="#">Chia sẻ</a> &nbsp;';
			if(login_id == row.pcom_user_id){
				html += '<a href="javascript:vold(0);" onclick="ajax_delete(\'reply_' + row.pcom_id + '\',\'/ajax/comment.php\',' + row.pcom_id + ')"><img src="/images/delete.gif" border="0" /></a>';
			}
			html += '</div>';
			html += '</div>';
			html += '<div class="clear"></div>';
			html += '<div class="break_line"></div>';
			html += '</div>';
	var old_html = $("#"+div_id).html();
	$("#"+div_id).html(html + old_html);

}
function htmlspecialbo(message){
	message = decodeURIComponent(message);
	message = message.replace(/>/gi, '');
	message = message.replace(/</gi, '&lt;');
	message = message.replace(/\{#br#\}/gi, '<br />');
	message = message.replace(/:p/gi, '<img src="/images/emos/tongue.png" alt=":P" />');
	message = message.replace(/:d/gi, '<img src="/images/emos/grin.png" alt=":D" />');
	message = message.replace(/:\)/gi, '<img src="/images/emos/smile.png" alt=":)" />');
	message = message.replace(/:\(/gi, '<img src="/images/emos/sad.png" alt=":(" />');
	message = message.replace(/;\)/gi, '<img src="/images/emos/wink.png" alt=";)" />');
	message = message.replace(/:o/gi, '<img src="/images/emos/shock.png" alt=":o" />');
	message = message.replace(/:-\?/gi, '<img src="/images/emos/39.gif" alt=":-?" />');
	return message;
}


