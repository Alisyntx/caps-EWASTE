$(document).ready(function () {
    // reward items input error
     $(document).on('click','.btnRwdItem', function(e){
        e.preventDefault();
        
        var url = 'components/dialogs/rwdInfo.php';
        var dataId = $(this).attr("id");
        $.post(url, {rwdId : dataId},
            function (response) {
                  $('#infoItemRwdModal').html(response);
            });
    });

     $('.menu-dropdown-toggle').click(function() {
      $(this).toggleClass('menu-dropdown-show');
      $(this).next('.menu-dropdown').toggleClass('menu-dropdown-show');
    });

    $("#formSaveRwdItem").submit(function(e) {
        e.preventDefault();
        var url = 'php/addRwd.php';
        var data = $(this).serialize();
            $.post(url, data, function(response) {
                alert(response.msg);
            });
    });

    function showError(message) {
        const alertHtml = `
            <div role="alert"  class="animate__animated animate__flash font-popin text-sm alert p-1 rounded-lg shadow-sm">
                <i class='bx bx-error text-xl text-red-600'></i>
                <span>${message}</span>
            </div>`;
        $('#error').html(alertHtml).removeClass('hidden');
    }

    function checkRwdInputs() { 
        const info = $('#info').val().trim();
        const points = $('#points').val().trim();

        if ( info && points) {
            $('button[type="submit"]').removeAttr('disabled').removeClass('disabled');
             $('#error').addClass('hidden');
        } else {
            $('button[type="submit"]').attr('disabled', 'disabled').addClass('disabled');
             showError("Please fill out all fields!");
        }
    }
    
     function updateRwdPreview() {
        $('#previewPoints').val($('#points').val());
        $('#previewItem').val($('#info').val());
    }

    $('#info, #points').on('input change', function() {
        checkRwdInputs();
        updateRwdPreview();
    });
    
    // pages script linti bilatiibay d ko kabalomag customize sang datatables aghhhh mwaaa uuuwaaaa
    //  $('#dataTbl').DataTable();
       $('#dataTbl').DataTable({
            "pagingType": "simple", // Use simple pagination controls
            "lengthMenu": [5, 10, 15, 20], // Control the length options
            "language": {
                "search": "",
                "searchPlaceholder": "Search records"
            },
            "dom": '<"top"f>rt<"bottom"><"clear">'
        });
        //   $('#dt-search-0').val('Your Custom Value');
    // handling approve buttons
    $('#dataTbl').on('click', '.acceptRwd', function() {
        var url = '../../php/accRwd.php';
        var rqsId = $(this).attr("id");
        var usrId = $(this).data("usr-id");
        var points = $(this).data("points");
        
        // Alert to check if the values are being retrieved correctly
        // alert("User ID: " + usrId + ", Points: " + points);
        
        var me = $(this);
        $.post(url, { akoSiID: rqsId, userId: usrId, points: points }, function(response) {
             response = JSON.parse(response);
            alert(response.message)
            me.closest('tr').fadeOut();
        });
    });
});