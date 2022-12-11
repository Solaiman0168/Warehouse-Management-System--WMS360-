function unread(id){
$.ajax({
type: "POST",
url:"{{url('unread')}}",
data: {
"_token" : "{{csrf_token()}}",
"order_id" : id
},
success: function (response) {
if(response.data !== 'error'){
console.log(id)
if(response.data == 1){
$("#customCheck"+id).hide();
$("#customCheck"+id).prop("checked",false);
$("#unread"+id).hide();
}
countCheckedAll()
// var info = '';
// if(response.buyerMessage.buyer_message){
//     info += '<div class="alert alert-warning text-dark"> Buyer Note : '+response.buyerMessage.buyer_message+'</div>'
//     $('table tbody tr td.checkboxShowHide'+id).html('<input type="checkbox" class="checkBoxClass" id="customCheck'+id+'" value="'+id+'">')
// }
// if(response.data){
//     info += '<strong>Note Create Date : ' + response.data.created_at + '</strong><br>' +
//         '<strong>Note : </strong>\n' +
//         '<p class=""></p>' +
//         '<textarea class="form-control" name="order_note_view" id="order_note_view" cols="5" rows="3" placeholder="Type your note here..">' + response.data.note + '</textarea>\n' +
//         '<strong>Created By : ' + creatorName + '</strong>' +
//         '<strong class="pull-right">Modified By : ' + modifierName + ' (' + response.data.updated_at + ')' + '</strong>'
//     // infoModal.find('.modal-body-view')[0].innerHTML = info;
//     // infoModal.modal();
//     $('#orderNoteModalView .modal-footer .update-note').attr('id',response.data.id);
//     $('#orderNoteModalView .modal-footer .delete-note').attr('id',response.data.id);
//     $('#orderNoteModalView .modal-footer').removeClass('d-none')
// }else{
//     $('#orderNoteModalView .modal-footer').addClass('d-none')
// }
// infoModal.find('.modal-body-view')[0].innerHTML = info;
// infoModal.modal();
}else{
alert('Something went wrong');
}
}
});
}
