<script setup>

</script>

<template>
    <div class="d-flex justify-content-between mb-4" id="toolbar">
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary">Add Item</button>
            <button class="btn btn-outline-warning">Edit</button>
            <button class="btn btn-outline-danger">Delete</button>
        </div>
        <div class="d-flex gap-3">
            <input class="form-control" type="search" placeholder="Search by table">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead class="table-light">
            <tr>
                <th scope="col"></th>
                <th scope="col">Custom ID</th>
                <th scope="col">Title</th>
                <th scope="col">Created at</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>1</td>
                <td>Mark</td>
                <td>@mdo</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
