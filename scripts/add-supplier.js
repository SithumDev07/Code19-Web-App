$(document).ready(function() {
    $("#AddSupplier").click(function() {
        $(".supplier-form-container").load("operations/get-supplier-data.php", {}, function() {
            // document.querySelector('.transformin-icon').classList.toggle('translate-icon');
            // if(toggleText) {
            //     document.querySelector('.change-text-crew').innerHTML = "Cancel";
            // } else {
            //     document.querySelector('.change-text-crew').innerHTML = "Recruit Employee";
            // }
            toggleText = !toggleText;
            document.querySelector('.add-supplier-form').classList.toggle('hidden');
            document.querySelector('.add-supplier-form').classList.toggle('flex');
            document.querySelector('.supplier-form-container').classList.toggle('hidden');
            document.querySelector('.supplier-form-container').classList.toggle('block');
            console.log('Working Supplier');
        });
    })
})