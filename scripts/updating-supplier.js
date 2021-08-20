let supplierCards = document.querySelectorAll('.card-suppliers');

$(document).ready(function() {
    let supplierId;
    supplierCards.forEach((ele,index) => {
        $(ele).click(function() {
            supplierId = ele.querySelector('.card-supplier-id').innerHTML;

            $(".supplier-form-container").load("operations/get-card-supplier-data.php", {
                id: supplierId,
            }, function() {
                UpdateListenerSupplier();
            })
        })
    })
    toggleText = true;
    function UpdateListenerSupplier() {
        document.querySelector('.transformin-icon').classList.toggle('translate-icon');
        if(toggleText) {
            document.querySelector('.change-text-supplier').innerHTML = "Cancel";
        } else {
            document.querySelector('.change-text-supplier').innerHTML = "Recruit Employee";
        }
        toggleText = !toggleText;
        document.querySelector('.add-supplier-form').classList.toggle('hidden');
        document.querySelector('.add-supplier-form').classList.toggle('flex');
        document.querySelector('.supplier-form-container').classList.toggle('hidden');
        document.querySelector('.supplier-form-container').classList.toggle('block');
        console.log('Working Updated Supplier');

        ListenOnInputChanges(document.querySelector('#supplierName'), 'supplier')
        ListenOnInputChanges(document.querySelector('#supplierEmail'), 'supplier')
        ListenOnInputChanges(document.querySelector('#supplierAddress'), 'supplier')
        ListenOnInputChanges(document.querySelector('#supplierPersonalNumber'), 'supplier')
        ListenOnInputChanges(document.querySelector('#supplierLandLine'), 'supplier')
        
        
        $("#UpdateSupplier").click(function(){
            console.log('Update Clicked');
            const form_data = new FormData();
            const image = $("#SupplierUploadProfile")[0].files;
            console.log(image[0]);

            const name = $("#supplierName").val();
            const email = $("#supplierEmail").val();
            const address = $("#supplierAddress").val();

            const personalNumber = $("#supplierPersonalNumber").val();
            const landLine = $("#supplierLandLine").val();
            const supplierId = $("#SupplierId").val();
            const SupplierPreviousProfile = $("#SupplierPreviousProfile").val();

            toggleText = true;
            const SupplierImageContainer = document.querySelector('.SupplierImageContainer')
            if(!(validateCrewForms(name, email, address, personalNumber, undefined, undefined, landLine, false, document.querySelector('#SupplierUploadProfile'), SupplierImageContainer, 'supplier'))) {
                console.log('Not Validated');
                $(".supplier-error-message").removeClass("hidden");
            }else {
                console.log('Validated');
                $(".supplier-error-message").addClass("hidden");

                form_data.append('profileUpload', image[0]);
                form_data.append('name', name);
                form_data.append('email', email);
                form_data.append('address', address);
                form_data.append('mobile', personalNumber);
                form_data.append('landline', landLine);
                form_data.append('id', supplierId);
                form_data.append('prev_file', SupplierPreviousProfile);

                $.ajax({
                    url: 'operations/update-supplier.php',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response);
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

        $("#DeleteSupplier").click(function() {
            console.log('Deleting Supplier');

            toggleText = true;
        
            const form_data = new FormData();
            const SupplierId = $("#SupplierId").val();
            const SupplierPreviousProfile = $("#SupplierPreviousProfile").val();
            form_data.append('id', SupplierId);
            form_data.append('prev_file', SupplierPreviousProfile);
            $.ajax({
                url: 'operations/delete-supplier.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response);
                    // console.log(response);
                    location.reload();
                }
            });
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