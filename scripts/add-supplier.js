$(document).ready(function() {
    toggleText = true;
    $("#AddSupplier").click(function() {
        $(".supplier-form-container").load("operations/get-supplier-data.php", {}, function() {
            SupplierListening();
        });
    })

    function SupplierListening() {
        ListenOnInputChanges(document.querySelector('#supplierName'), 'supplier')
        ListenOnInputChanges(document.querySelector('#supplierEmail'), 'supplier')
        ListenOnInputChanges(document.querySelector('#supplierAddress'), 'supplier')
        ListenOnInputChanges(document.querySelector('#supplierPersonalNumber'), 'supplier')
        ListenOnInputChanges(document.querySelector('#supplierLandLine'), 'supplier')
    
        document.querySelector('.transformin-icon').classList.toggle('translate-icon');
        if(toggleText) {
            document.querySelector('.change-text-supplier').innerHTML = "Cancel";
        } else {
            document.querySelector('.change-text-supplier').innerHTML = "Add Supplier";
        }
        toggleText = !toggleText;
        document.querySelector('.add-supplier-form').classList.toggle('hidden');
        document.querySelector('.add-supplier-form').classList.toggle('flex');
        document.querySelector('.supplier-form-container').classList.toggle('hidden');
        document.querySelector('.supplier-form-container').classList.toggle('block');
        console.log('Working Supplier');

        $("#InsertSupplier").click(function(e) {
            e.preventDefault();

            const form_data = new FormData();
            const image = $("#SupplierUploadProfile")[0].files;
            console.log(image[0]);

            const name = $("#supplierName").val();
            const email = $("#supplierEmail").val();
            const address = $("#supplierAddress").val();

            const personalNumber = $("#supplierPersonalNumber").val();
            const landLine = $("#supplierLandLine").val();

            let toggleText = true;
            const SupplierImageContainer = document.querySelector('.SupplierImageContainer')
            if(!(validateCrewForms(name, email, address, personalNumber, undefined, undefined, landLine, true, document.querySelector('#SupplierUploadProfile'), SupplierImageContainer, 'supplier'))) {
                console.log('Not Validated');
                $(".supplier-error-message").removeClass("hidden");
            }else {
                $(".supplier-error-message").addClass("hidden");

                form_data.append('profileUpload', image[0]);
                form_data.append('name', name);
                form_data.append('email', email);
                form_data.append('address', address);
                form_data.append('mobile', personalNumber);
                form_data.append('landline', landLine);

                $.ajax({
                    url: 'operations/add-new-supplier.php',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response);
                        // console.log(response);
                        document.querySelector('.transformin-icon').classList.toggle('translate-icon');
                        if(toggleText) {
                            document.querySelector('.change-text-supplier').innerHTML = "Cancel";
                        } else {
                            document.querySelector('.change-text-supplier').innerHTML = "Add Supplier";
                        }
                        toggleText = !toggleText;
                        document.querySelector('.supplier-form-container').classList.toggle('hidden');
                        document.querySelector('.supplier-form-container').classList.toggle('flex');
                        location.reload();
                    }
                });
            }
        })

        $(function(){
       
            $('#SupplierUploadProfile').change(function(){
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
                 {
                    var reader = new FileReader();
            
                    reader.onload = function (e) {
                        $(".SupplierImageContainer").removeClass("border-blue-600")
                        $(".SupplierImageContainer").removeClass("border-red-500")
                        $(".SupplierImageContainer").addClass("border-green-500")
                       $('#supplierUploadedProfile').attr('src', e.target.result);
                    }
                   reader.readAsDataURL(input.files[0]);
                }
                else
                {
                  $('#SupplierUploadProfile').attr('src', '/assets/no_preview.png');
                }
              });
        });

        
    }


    
})

