<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h6>Category</h6>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0 btn-sm bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-secondary" />
                <div class="table-responsive">
                    <table class="table  table-flush" id="tableData">
                        <thead>
                            <tr class="bg-light">
                                <th>No</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableList">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    getCategoryList()
    async function getCategoryList() {

        showLoader();
        let res = await axios.get("/list-category");
        hideLoader();

        // let tableList = document.getElementById('tableList');
        // let tableData = document.getElementById('tableData');

        let tableList = $('#tableList');
        let tableData = $('#tableData');

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item, index) {
            let row =
                `<tr>
                    <td>${index + 1}</td>
                    <td>${item['name']}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn edit-btn btn-sm btn-outline-promary">Edit</button>
                        <button data-id="${item['id']}" class="btn delete-btn btn-sm btn-outline-danger">Delete</button>

                        </td>
                </tr>`
            tableList.append(row)
        })


        $('.edit-btn').on('click', async function() {
            let id = $(this).data('id');
            $('#update-modal').modal('show');
            await fillUpUpdateForm(id);
            // $('#updateID').val(id);
        });

        $('.delete-btn').on('click', function() {
            let id = $(this).data('id');
            $('#delete-modal').modal('show');
            $('#deleteID').val(id);
        });

        // tableData.DataTable({
        //     order: [
        //         [0, 'asc']
        //     ],
        //     aLengthMenu: [5, 10, 15, 20, 25],
        // });

        new DataTable('#tableData', {
            order: [
                [0, 'desc']
            ],
            lengthMenu: [5, 10, 15, 20, 30]
        });

    }
</script>
