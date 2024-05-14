<?php 

require('includes/header.php');
require('includes/database/db_controllers.php');


$admins = selectAll('admin', ['Main' => 0]);

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
    <div class="wrap h-screen" style="background:#F9F9F9; overflow-x:hidden">
        <div class="row">
            <div class="col-md-2 col-lg-2 col-xl-2">
                <?php include('sidenav.php') ?>
            </div>
            <div class="col-md-10 col-lg-10 col-xl-10" style='padding:0% 2%'>
                <div class=" mt-2 table-container">
                    <div class=" w-full p-2 rounded-md  my-3 bg-white flex justify-between items-center ">
                        <div class=" w-full p-2 rounded-md  my-3 bg-white flex justify-between items-center ">
                            <div>
                                <h4 class="font-bold text-red-600 uppercase my-3 text-sm">Page</h4>
                                <div class="flex space-x-1 items-center">
                                    <img src="../assets/images/profile.png" alt="" width="25px">
                                    <p class="font-bold uppercase text-md "> All Admins</p>
                                </div>
                            </div>
                            <div>
                                <a href="add_admins.php">
                                    <button class="px-2 py-2 bg-red-300 rounded-md text-white">
                                        <img src="../assets/images/add.png" alt="" width="25px">
                                    </button>
                                </a>

                            </div>
                        </div>

                    </div>
                    <table class="table table-bordered  table-hover" id="adminTable" style="width:100%; ">
                        <thead>
                            <tr>

                                <th scope="col">S/N</th>
                                <th scope="col">Fullname</th>
                                <th scope="col">AdminId/Email</th>
                                <th scope="col"> Role</th>
                                <th scope="col"> Phone</th>
                                <th scope="col">Action</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach($admins as $key=>$admin): ?>
                            <tr>

                                <th scope="row"><?php echo $key + 1  ?></th>
                                <td><?php echo $admin['Fullname']  ?></td>
                                <td><?php echo $admin['AdminId'] ?></td>
                                <td><?php echo $admin['Role'] ?></td>
                                <td><?php echo $admin['Phone'] ?></td>




                                <td><a href="edit_admin.php?id=<?php echo $admin['id'] ?>"><button
                                            id="<?php echo $admin['id'] ?>"
                                            class="px-2 py-1 bg-blue-200 rounded-lg flex space-x-1 items-center"
                                            onclick='editid(this)'><img src="../assets/images/editing.png" alt=""
                                                style="width:15px;"><span class="font-semibold"
                                                style="font-size: 10px;">Edit</span></button></a>
                                </td>
                                <td><button id="<?php echo $admin['id'] ?>"
                                        class="px-2 py-1 bg-red-200 rounded-lg flex space-x-1 items-center"
                                        onclick='deleteid(this)'><img src="../assets/images/delete 4.png" alt=""
                                            style="width:15px;"><span class="font-semibold"
                                            style="font-size: 10px;">Delete</span></button></td>
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
        $('#adminTable').DataTable({
            scrollX: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "E.g. John Doe"
            }
        });
    })


    function deleteid(e) {
        var adminid = e.id

        Swal.fire({
            title: 'Do you want to delete this admin?',
            showCancelButton: true,
            confirmButtonText: 'Delete',

        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: 'ajax_controls/admin_delete_admin.php',
                    method: 'post',
                    data: {
                        id: adminid
                    },
                    success: function(data) {
                        if (data == 'success') {

                            Swal.fire({
                                icon: 'success',
                                title: 'Congratulations',
                                text: 'This admin has been Deleted Successfully',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then(function() {
                                window.location = "admins.php";
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