<script setup>

</script>

<template>
    <h3>My inventories</h3>
    <hr>
    <div class="d-flex justify-content-between mb-4" id="toolbar">
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary">Add Inventory</button>
            <button class="btn btn-outline-warning">Edit</button>
            <button class="btn btn-outline-danger">Delete</button>
        </div>
        <div class="d-flex gap-3">
            <input class="form-control" type="search" placeholder="Search by table">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sorted by
                    <i class="bi bi-arrow-down-up"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><button class="dropdown-item" type="button">Title <i class="bi bi-arrow-down-short"></i></button></li>
                    <li><button class="dropdown-item" type="button">Title <i class="bi bi-arrow-up-short"></i></button></li>
                    <li><button class="dropdown-item" type="button">Created at <i class="bi bi-arrow-down-short"></i></button></li>
                    <li><button class="dropdown-item" type="button">Created at <i class="bi bi-arrow-up-short"></i></button></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead class="table-light">
            <tr>
                <th scope="col"></th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col">Access</th>
                <th scope="col">Created at</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
