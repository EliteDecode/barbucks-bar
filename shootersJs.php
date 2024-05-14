<script>
function calculateQuantityUsed(event) {
    var target = event.target;
    var td = target.parentNode;
    var tr = td.parentNode;

    var quantity1 = parseInt(tr.getElementsByTagName("input")[0].value);
    var quantity2 = parseInt(tr.getElementsByTagName("input")[1].value);
    var quantity3 = parseInt(tr.getElementsByTagName("input")[2].value);

    const total = quantity1 + quantity2 + quantity3

    changeTotalQuantityUsed(total, event)
    calculateTestTubes(event)
    calculateProfit(event)
    calculateTotalProfit(event)

}

function changeTotalQuantityUsed(value, event) {
    var target = event.target;
    var td = target.parentNode;
    var tr = td.parentNode;
    var tubeType = parseInt(tr.getElementsByTagName("select")[6].value)
    tr.getElementsByTagName("input")[3].value = value
    tr.getElementsByTagName("input")[4].value = value / tubeType
}

function calculateTestTubes(event) {
    var target = event.target;
    var td = target.parentNode;
    var tr = td.parentNode;
    var tubeType = tr.getElementsByTagName("select")[6].value
    var qauntityUsed = tr.getElementsByTagName("input")[3].value
    tr.getElementsByTagName("input")[4].value = qauntityUsed / tubeType

    calculateProfit(event)
    calculateTotalProfit(event)
}

function calculateProfit(event) {
    var target = event.target;
    var td = target.parentNode;
    var tr = td.parentNode;
    var tubeType = tr.getElementsByTagName("input")[4].value
    var qauntityUsed = tr.getElementsByTagName("input")[5].value
    tr.getElementsByTagName("input")[6].value = qauntityUsed * tubeType
    calculateTotalProfit(event)


}




function calculateTotalProfit(event) {

    const inputs = document.querySelectorAll('.total_input');
    let sum = 0;


    for (let i = 0; i < inputs.length; i++) {
        sum += parseFloat(inputs[i].value);
    }


    document.getElementById("TotalValue").innerHTML = sum.toFixed(2);


}



function addRow(button) {
    var table = document.querySelector('.table');
    var rows = table.rows;

    // Define a CSS class with the "display" property set to "none"

    // Insert the cells and add the "hidden" class to the corresponding cells
    var table = button.closest("table"); // find the closest table element
    var rowIndex = button.closest("tr").rowIndex; // get the index of the current row
    var newRow = table.insertRow(rowIndex + 1); // insert a new row after the current row
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    var cell3 = newRow.insertCell(2);
    var cell4 = newRow.insertCell(3);

    var cell5 = newRow.insertCell(4);
    var cell6 = newRow.insertCell(5);
    var cell7 = newRow.insertCell(6);
    var cell8 = newRow.insertCell(7);
    var cell9 = newRow.insertCell(8);
    cell2.classList.add('space-y-2')
    cell3.classList.add('space-y-2')
    cell4.classList.add('space-y-2')





    var rowOriginal = table.rows[rowIndex]; // second row (index 1)
    var cells_original = rowOriginal.cells; // array of cells in the row

    var parentRow = button.parentNode.parentNode;









    cell1.innerHTML = `<i class='fa fa-minus' ></i>`; // set the content of the th element
    cell2.innerHTML =
        ` <select name="product[]" id="product" class='form-control'>
                                               
                                            </select>
                                            <select name="category[]" id="category" class='form-control'>
                                                <option value="26">26</option>
                                                <option value="40">40</option>

                                            </select>
                                            <input type="number" class="form-control" placeholder="Quantity used"
                                                value='0' name='quantity_used[]'
                                                onblur='calculateQuantityUsed(event)' />`;
    cell3.innerHTML =
        ` <select name="product[]" id="product" class='form-control'>
                                               
                                            </select>
                                            <select name="category[]" id="category" class='form-control'>
                                                <option value="26">26</option>
                                                <option value="40">40</option>

                                            </select>
                                            <input type="number" class="form-control" placeholder="Quantity used"
                                                value='0' name='quantity_used[]'
                                                onblur='calculateQuantityUsed(event)' />`;
    cell4.innerHTML =
        ` <select name="product[]" id="product" class='form-control'>
                                              
                                            </select>
                                            <select name="category[]" id="category" class='form-control'>
                                                <option value="26">26</option>
                                                <option value="40">40</option>

                                            </select>
                                            <input type="number" class="form-control" placeholder="Quantity used"
                                                value='0' name='quantity_used[]'
                                                onblur='calculateQuantityUsed(event)' />`;
    cell5.innerHTML =
        ` <input type="number" class="form-control" placeholder="0" readonly
                                                name='totalq_sold[]' />`
    cell6.innerHTML = `  <select name="tubeType[]" id="tubeType" class='form-control'  onchange='calculateTestTubes(event)'>
                                                <option value="1">1 Ounce</option>
                                                <option value="0.5">1/2 Ounce</option>
                                                <option value="0.25">1/4 Ounce</option>

                                            </select>`;
    cell7.innerHTML = ` <input type="number" class="form-control" name="test_tubes[]"
                                                class="form-control" oninput="" readonly value='0' />`;
    cell8.innerHTML = ` <input type="number" name="price[]" class="form-control" readonly
                                                value='3' /> `;
    cell9.innerHTML = `   <input type="number" name="total[]" class="form-control total_input"
                                                readonly value='0' />`;


}





function savedata() {
    var currentTime = $('#current_date').val();
    Swal.fire({
        title: 'Do you want to save this data?',
        showCancelButton: true,
        confirmButtonText: 'Save',

    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var tableData = [];
            var totalProfit = $('#TotalValue').text();
            var barId = $('#barId').val()
            var bar = $('#bar').val()
            var measurement = $('#measurement').val()

            console.log(bar)

            $("#postTable tr").each(function(rowIndex, r) {
                var cols = [];
                $(this).find("td").each(function(colIndex, c) {
                    var inputVal = "";
                    var selectVal = "";
                    if ($(c).find("input").length) {
                        inputVal = $(c).find("input").val();
                    } else if ($(c).find("select").length) {
                        selectVal = $(c).find("select").val();
                    }
                    if ($(c).hasClass("space-y-2")) {
                        var select1Val = $(c).find("select[name='product[]']").val();
                        var select2Val = $(c).find("select[name='category[]']").val();
                        var inputVal = $(c).find("input[name='quantity_used[]']").val();
                        cols.push(select1Val, select2Val, inputVal);
                    } else {
                        cols.push(inputVal + selectVal);
                    }
                });
                tableData.push(cols);
            });


            $.ajax({
                type: 'post',
                url: 'admin/ajax_controls/saveDataShooters.php',
                data: {
                    table_data: tableData,
                    totalProfit,
                    barId,
                    bar
                },
                success: function(response) {
                    $('#msg').html(response);

                    if (response.includes('success')) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'This Data has been Saved Successfully',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        }).then(function() {

                            window.location =
                                `shooters.php?bar=${bar}&status=saved&date=${currentTime}&measurement=${measurement}`;
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong...',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })
                    }
                }
            });
        }
    })
}



function fetchdata() {
    var date_input = $('#date_input').val();

    if (date_input != "") {
        var bar = $('#bar').val()
        var measurement = $('#measurement').val()
        window.location = `shooters.php?measurement=${measurement}&bar=${bar}&status=saved&date=${date_input}`;
    } else {
        $("#date_input").removeClass('form-control').addClass('form-control is-invalid');
    }

}

function changeMeasurement(event) {
    const value = event.target.id
    var bar = $('#bar').val()
    if (value == 'ounce') {
        window.location = `shooters.php?bar=${bar}&measurement=ounce`;
    } else {
        window.location = `shooters.php?bar=${bar}&measurement=grams`;
    }
}

function refreshdata() {
    var measurement = $('#measurement').val()
    var bar = $('#bar').val()
    window.location = `shooters.php?bar=${bar}&measurement=${measurement}`;
}
</script>