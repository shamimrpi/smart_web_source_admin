
const search = (searchUrl) => {
   
    $.ajax({
        url: searchUrl,
        type: "get",
        data: $('#frmSearch').serialize(),
        success: function (data) {
            $('#ajax_content').html(data);
            updatedue();
            document.querySelectorAll('.number_format').forEach((item) => {
                let value = Number(item.innerText);
                if (value) {
                    item.innerHTML = value.toLocaleString('en-IN')
                }
            })
           if(data.status == 'error'){
             toastr.error(data.message);
           }
          
        },
        error: function (xhr, status) {
            alert('There is some error.Try after some time.');
        }
    });
}

$(document).on('click', '#ajaxPaginate nav div div span a', function (event) {
    event.preventDefault();
    search($(this).attr('href'));
})

$(document).on('submit', '#frmSearch', function (event) {
    event.preventDefault();
    search(this.action)
})

