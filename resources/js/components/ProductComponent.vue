<template>
  <div class="container my-5">
    
    <div class="row">

        <div class="col-4">
            <!-- .card>.card-header+.card-body -->
            <div class="card">
                <h3 class="card-header">Create</h3>
                <div class="card-body">
                    <form action="">
                        <div class="form-group mb-3">
                            <label>Name: </label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label>Price: </label>
                            <input type="number" class="form-control">
                        </div>

                        <button class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>

            

        </div>

        <div class="col-8">
                <table class="table table-striped">
                    <thead>
                        <!-- tr>th*4 -->
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr scope="row">
                            <td>1</td>
                            <td>Book</td>
                            <td>1000</td>
                            <td>
                                <!-- <button type="button" class="btn btn-success">Edit</button>
                                <button type="button" class="btn btn-info">Show</button>
                                <button type="button" class="btn btn-danger delete">Delete</button> -->

                                <button type="button" class="btn btn-primary">Edit</button>
                                <button type="button" class="btn btn-success">Success</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

    </div>


  </div>
</template>

<script>
export default {

}
</script>

