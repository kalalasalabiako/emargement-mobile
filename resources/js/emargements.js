import SignaturePad from 'signature_pad';

var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});
var saveButton = document.getElementById('save');
var cancelButton = document.getElementById('clear');

var signatureInput = document.getElementById('signature_input');
var form = document.getElementById('signature-form')

saveButton.addEventListener('click', function (event) {
if(signaturePad.isEmpty()) {
event.preventDefault();
alert('Veuillez signer avant d\'enregistrer!');
return;
}
  signatureInput.value = signaturePad.toDataURL('image/png');

// Send data to server instead...
form.submit();
});

cancelButton.addEventListener('click', function (event) {
  signaturePad.clear();
});
