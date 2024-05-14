<?php 
require('includes/header.php');
require('includes/database/db_controllers.php');

 $posts = selectAll('inventory', ['Category' => 'Liquor']);

?>


<style>
.table-container {

    width: 95%;
    margin: 0% 2.5%;
}

@media (min-width: 0px) and (max-width: 575px) {

    .table-container {
        width: 90%;
        margin: 0% 5% !important;
    }
}

thead tr th {
    font-size: 16px;
}

tbody tr td {
    font-size: 12px;
}

.dataTables_length select {
    border: 2px solid #171d64 !important;
    width: 90px !important;
    margin: 3% 0%;
}


.dataTables_length label,
.dataTables_info {
    font-weight: bold;
    text-transform: uppercase;
    font-size: 12px;
}

.paginate_button {
    font-weight: bold;
    text-transform: capitalize;
    font-size: 14px;


}

.dataTables_filter input {
    content: "e.g. jonhdoe";
    height: 35px;
    width: 200px;
    border: 2px solid #171d64 !important;
    font-size: 14px;
    margin: 3% 0%;
}


.dataTables_wrapper {
    background-color: #fff;
    padding: 3% 4%;
    border-radius: 10px;
}
</style>

<?php include ('nav.php') ?>

<body>
    <div class="wrap h-screen" style=" background:#F9F9F9; overflow-x:hidden">
        <div class="row">
            <div class="col-md-2 col-lg-2 col-xl-2">
                <?php include('sidenav.php') ?>
            </div>
            <div class="col-md-10 col-lg-10 col-xl-10" style='padding:0% 2%'>
                <div class=" mt-2 table-container">
                    <div class=" w-full p-2 rounded-md  my-3 bg-white flex justify-between items-center ">
                        <div>
                            <h4 class="font-bold text-red-600 uppercase my-3 text-sm">Page</h4>
                            <div class="flex space-x-1 items-center">
                                <img src="../assets/images/liquor.png" alt="" width="25px">
                                <p class="font-bold uppercase text-md "> All Liquors Available</p>
                            </div>
                        </div>

                    </div>
                    <table class="table table-bordered  table-hover" id="postTable" style="width:100%; ">
                        <thead>
                            <tr>

                                <th scope="col">S/N</th>
                                <th scope="col">Product</th>
                                <th scope="col">Category</th>
                                <th scope="col">Q/Ounce</th>
                                <th scope="col">Q/Bottles</th>
                                <th scope="col">Price per can ($)</th>
                                <th scope="col">Price of drink ($)</th>


                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach($posts as $key=>$post): ?>
                            <tr>

                                <th scope="row"><?php echo $key + 1  ?></th>
                                <td><?php echo $post['Product']  ?></td>
                                <td><?php echo $post['Type']  ?></td>
                                <td><?php echo number_format($post['Quantity'])  ?></td>
                                <td><?php echo number_format($post['Quantity']/$post['Type'])  ?></td>
                                <td><?php echo $post['Price_per_can']  ?></td>
                                <td><?php echo $post['Price_of_drink'] ?></td>


                            </tr>
                            <?php endforeach;?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





    <?php include('includes/footer.php')?>

    <script>
    jQuery(document).ready(function($) {
        $('#postTable').DataTable({
            scrollX: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "E.g. Don Julio"
            }
        });
    })


    function deleteid(e) {
        var postid = e.id

        Swal.fire({
            title: 'Do you want to delete this data?',
            showCancelButton: true,
            confirmButtonText: 'Delete',

        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: 'ajax_controls/delete_liquors.php',
                    method: 'post',
                    data: {
                        id: postid
                    },
                    success: function(data) {
                        if (data == 'success') {

                            Swal.fire({
                                icon: 'success',
                                title: 'Congratulations',
                                text: 'This data has been Deleted Successfully',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then(function() {
                                window.location = "liquors.php";
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
                    },

                })
            }
        })


    }
    </script>

</body>

</html>