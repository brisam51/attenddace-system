$(function(){
    // Select all input fields with the class "persian-number"
    // Attach input event listener to all fields with the 'persian-number' class
    $('.persian-number').on('input', function () {
        // Regular expression to match Persian digits
        const persianDigitsRegex = /^[\u06F0-\u06F9]+$/;

        // Get the current value of the input field
        let value = $(this).val();

        // Remove invalid characters (non-Persian digits)
        if (!persianDigitsRegex.test(value)) {
            $(this).val(value.replace(/[^۰-۹]/g, ''));
        }
    });
    //persian date input fields
    $(".persian-date").persianDatepicker({
        format: "YYYY/MM/DD",
        //observer: true,
        onSelect: function (unixTimestamp) {
            const persiandate = $("#date_employment").val();
            //convert persian data to gregorian date
            const gregorianDate = moment(persiandate, "jYYYY/jM/jD").format("YYYY-MM-DD");
           

        }
    });
//    birthdate
$(".birthdate").persianDatepicker({
    observer: true,
    format: 'YYYY/MM/DD',
  });

// Convert number to Persian digits
function toPersianNumber(number) {
    var farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    return number.toString().replace(/\d/g, (digit) => farsiDigits[digit]);
}



// Convert numbers in specific table cells to Persian digits
function ConverttoPersianTableNumber() {
    // Target only specific classes: national-id, card-id, and birth-date
    $('.national-id, .card-id, .birth-date,.birth_date-lable,.input-form,form-control ,.start_date, .end_date,.task_code,.task-hourly-wages').each(function() {
        var cellText = $(this).text();
        var inputText = $(this).val();
        // Replace all numbers in the cell text with Persian digits
        $(this).text(cellText.replace(/\d+/g, (match) => toPersianNumber(match)));
        $(this).val(inputText.replace(/\d+/g, (match) => toPersianNumber(match)));
    });
}

// Ensure the DOM is fully loaded before running the conversion
$(document).ready(function() {
    ConverttoPersianTableNumber();
});

// Image preview
$(".image-upload").on('change',function(event){
var file=event.target.files[0];
if(file){
    var reader=new  FileReader();
    reader.onload=function(e){
       $(".image-preview").attr('src',e.target.result).show();
    };
    reader.readAsDataURL(file);
}else{  $('.image-preview').hide();}

});


});//end class
