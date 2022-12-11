function view_note(id) {
console.log('test from partials');
// var id = $(this).attr('id');
$.ajax({
type: "POST",
url:"{{url('view-order-note')}}",
data: {
"_token" : "{{csrf_token()}}",
"order_id" : id
},
success: function (response) {
if(response.data !== 'error'){
var infoModal = $('#orderNoteModalView');
if(response.data){
var creatorName = (response.data.user_info == null) ? '' : response.data.user_info.name;
var modifierName = (response.data.modifier_info == null) ? '' : response.data.modifier_info.name;
}

//$("#customCheck"+id).show();
$("#unread"+id).show();

var info = '';
if(response.buyerMessage.buyer_message){
info += '<div class="alert alert-warning text-dark"> Buyer Note : '+response.buyerMessage.buyer_message+'</div>'
if(!$("#customCheck"+id).is(':checked')){
$('table tbody tr td.checkboxShowHide'+id).html('<input type="checkbox" class="checkBoxClass" id="customCheck'+id+'" value="'+id+'">')
}
}
if(response.data){

info += '<strong>Note Create Date : ' + response.data.created_at + '</strong><br>' +
'<strong>Note : </strong>\n' +
'<p class=""></p>' +
'<textarea class="form-control" name="order_note_view" id="order_note_view" cols="5" rows="3" placeholder="Type your note here..">' + response.data.note + '</textarea>\n' +
'<strong>Created By : ' + creatorName + '</strong>' +
'<strong class="pull-right">Modified By : ' + modifierName + ' (' + response.data.updated_at + ')' + '</strong>'
// infoModal.find('.modal-body-view')[0].innerHTML = info;
// infoModal.modal();
$('#orderNoteModalView .modal-footer .update-note').attr('id',response.data.id);
$('#orderNoteModalView .modal-footer .update-note').attr('data',response.data.order_id);
$('#orderNoteModalView .modal-footer .delete-note').attr('id',response.data.id);
$('#orderNoteModalView .modal-footer .delete-note').attr('data',response.data.order_id);
$('#orderNoteModalView .modal-footer').removeClass('d-none')
}else{
$('#orderNoteModalView .modal-footer').addClass('d-none')
}
var unread_button = '';
// console.log(response.buyerMessage.is_buyer_message_read);
if (response.buyerMessage.is_buyer_message_read == 1){
// $("#buttons").html('<button type="button" class="btn btn-dark update-note" id="unread'+response.buyerMessage.id+'" onclick="unread('+response.buyerMessage.id+');">Mark as Unread</button>')
$("#buttons").html('<button type="button" class="btn btn-danger" style="margin-right: 0%" id="unread'+response.buyerMessage.id+'" onclick="unread('+response.buyerMessage.id+');">Mark as Unread</button>\n' +
'                        ')
// $("#buttons").html('<button type="button" class="btn btn-danger" style="margin-right: 0%" id="unread'+response.buyerMessage.id+'" onclick="unread('+response.buyerMessage.id+');">Mark as Unread</button>\n' +
//     '                        <span aria-hidden="true">&times;</span>')
}

infoModal.find('.modal-body-view')[0].innerHTML = info;
infoModal.modal();
}else{
alert('Something went wrong');
}
}
});
}
