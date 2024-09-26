$(document).ready(function() {
// im trying to make this an oop to make it well organize
    // $(document).on('click','.btnItem', function(e){
    //     e.preventDefault();
    //     var url = '../src/admin/components/dialogs/dialogs.php';
    //     var dataId = $(this).attr("id");
    //     $.post(url, {getId : dataId},
    //         function (response) {
    //               $('#infoItemModal').html(response);
    //         });
    // });

    // $(document).on('click','.btnTbl', function(e){
    //     e.preventDefault();
    //     var url = 'components/dialogs/tables.php';
    //     var dataId = $(this).attr("id");
    //     $.post(url, {getId : dataId},
    //         function (response) {
    //               $('#modalTableDnt').html(response);
    //         });
    // });

// this is for deleting categories
    // $(document).on('click', '.delCty', function(e){
    //     e.preventDefault();
    //     var url = '../src/admin/components/dialogs/categories/deleteCty.php';
    //     var dataId = $(this).attr("id");
    //     $.post(url, {getId : dataId}, function(response){
    //         $('#delCty').html(response);
    //     });
    // });
    // $('#delCty').on('submit','#delCtyModal', function(e){
    //     e.preventDefault(e);
    //     var url = '../src/admin/php/categories/delCty.php';
    //     var data = $(this).serialize();
    //     $.post(url, data, function(response){
    //         delCty.close();
    //         alert(response.msg)
    //     });
    // })
//other way of deleting data
    // let ctyIdData;
    // $('.delCty').on('click', function(){
    // ctyIdData = $(this).data('id');
    // alert(ctyIdData);
    // });

// this is for adding Categories
    $("#formSaveCty").submit(function(e) {
        e.preventDefault();
        var url = '../src/admin/php/categories/addCty.php';
        var data = $(this).serialize();
        $.post(url, data, function(response) {
            if (response.scs) {
                // Append the new category to the DOM
               var msgAlert = `
                <div class="alert p-2 rounded-md bg-bgcard border border-bgborder animate__animated animate__backInRight">
                    <span class="text-xs font-popin">${response.msg}</span>
                </div>
                `;
                var alertElement = $(msgAlert).appendTo('#alertMsg');
                setTimeout(() => {
                    alertElement.fadeOut(500, function() {
                        $(this).remove();
                    });
                }, 5000);
                 ctyAddModal.close();

                var newCategoryHTML = `
                    <div class="mt-2 mb-5 bg-bgbox border border-bgborder w-full h-auto rounded-md  flex flex-col gap-1 shadow-md divide-y divide-bgborder">
                        <div class="p-1">
                            <button class="btn btn-xs outline bg-transparent outline-1 rounded-md outline-bgborder bg-bg text-bgtext text-xs font-popin">${response.cty_name}</button>
                        </div>
                        <div class=" ">
                            <div class="overflow-x-auto">
                                <table class="table table-xs" id="itemList">
                                    <!-- head -->
                                    <thead>
                                        <tr>
                                            <th>
                                            </th>
                                            <th>Name</th>
                                            <th>Condition</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan='4' class='text-center'>No items</td>
                                        </tr>
                                    </tbody>
                                    <!-- foot -->
                                </table>
                            </div>
                        </div>
                    </div>`;
                $('#ctyHtml').append(newCategoryHTML);
            }
        }, 'json');
    });

// this is for dropdown
    $('.menu-dropdown-toggle').click(function() {
      $(this).toggleClass('menu-dropdown-show');
      $(this).next('.menu-dropdown').toggleClass('menu-dropdown-show');
    });
// this is for add ewaste
    $("#formSaveItem").submit(function(e) {
        e.preventDefault();
        var url = 'php/addEwaste.php';
        var data = $(this).serialize();
            $.post(url, data, function(response) {
                alert(response.msg);
            });
    });
// this is alert to a user input for adding ewaste
    function checkInputs() {
        const user = $('#searchInput').val().trim();
        const category = $('#category').val();
        const info = $('#info').val().trim();
        const condition = $('#condition').val();
        const points = $('#points').val().trim();

        if (user && category && info && condition && points) {
            $('button[type="submit"]').removeAttr('disabled').removeClass('disabled');
             $('#error').addClass('hidden');
        } else {
            $('button[type="submit"]').attr('disabled', 'disabled').addClass('disabled');
             showError("Please fill out all fields!");
        }
    }
    function showError(message) {
        const alertHtml = `
            <div role="alert"  class="animate__animated animate__flash font-popin text-sm alert p-1 rounded-lg shadow-sm">
                <i class='bx bx-error text-xl text-red-600'></i>
                <span>${message}</span>
            </div>`;
        $('#error').html(alertHtml).removeClass('hidden');
    }
    function updatePreview() {
        $('#previewUser').val($('#searchInput').val());
        $('#previewCategory').val($('#category option:selected').text());
        $('#previewCondition').val($('#condition option:selected').text());
        $('#previewPoints').val($('#points').val());
        $('#previewItem').val($('#info').val());
    }

    $('#searchInput, #category, #info, #condition, #points').on('input change', function() {
        checkInputs();
        updatePreview();
    });

// this is for auto complete
    $('#searchInput').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '../src/admin/php/dataSearch.php', // Change this to the PHP file that handles the search
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 1, // Minimum length of input before autocomplete is triggered
            response: function(event, ui) {
                if (!ui.content.length) {
                    ui.content.push({ label: "No results found", value: null });
                }
            },
            select: function(event, ui) {
                var selectedValue = ui.item.value;
                var selectedId = ui.item.id; // Assuming the ID is included in the JSON data
                $('#userId').val(selectedId);
                // alert("Selected Value: " + selectedValue + ", Selected ID: " + selectedId);
            }
        });
});