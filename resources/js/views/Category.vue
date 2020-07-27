<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Catergory</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link to="/">Dashboard</router-link>
                            </li>
                            <li class="breadcrumb-item active">Catergory</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <button
                                    class="btn btn-primary btn-sm"
                                    v-on:click="showNewCategoryModal"
                                >
                                    <span class="fa fa-plus"></span> Create
                                    Category
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(category,
                                            index) in categories"
                                            :key="index"
                                        >
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ category.name }}</td>
                                            <td>
                                                <img
                                                    :src="
                                                        `${$store.state.serverPath}/storage/${category.image}`
                                                    "
                                                    :alt="category.name"
                                                    width="50%"
                                                    class="img-fluid"
                                                />
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-primary btn-sm"
                                                    type="button"
                                                    v-on:click="
                                                        editCategory(category)
                                                    "
                                                >
                                                    <span
                                                        class="fa fa-edit"
                                                    ></span>
                                                </button>
                                                <button
                                                    class="btn btn-danger btn-sm"
                                                    type="button"
                                                    v-on:click="
                                                        deleteCategory(category)
                                                    "
                                                >
                                                    <span
                                                        class="fa fa-trash"
                                                    ></span>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul
                                    class="pagination pagination-sm m-0 float-right"
                                >
                                    <li class="page-item">
                                        <a class="page-link" href="#"
                                            >&laquo;</a
                                        >
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"
                                            >&raquo;</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <b-modal
                ref="newCategoryModal"
                hide-footer
                title="Form New Category"
            >
                <form v-on:submit.prevent="createCategory">
                    <div class="form-group">
                        <label for="name">Enter Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            v-model="categoryData.name"
                            aria-describedby="categoryName"
                            placeholder="Enter your category name"
                        />
                        <div class="invalid-feedback" v-if="errors.name">
                            {{ errors.name[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Chosen an image</label>
                        <div v-if="categoryData.image.name">
                            <img ref="newCategoryImageDisplay" width="100%" />
                        </div>
                        <input
                            type="file"
                            v-on:change="attachImage"
                            class="form-control"
                            id="image"
                            ref="newCategoryImage"
                        />
                        <div class="invalid-feedback" v-if="errors.image">
                            {{ errors.image[0] }}
                        </div>
                    </div>
                    <hr />
                    <button
                        type="button"
                        class="btn btn-default"
                        v-on:click="hideNewCategoryModal"
                    >
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <span class="fa fa-check"></span> Save
                    </button>
                </form>
            </b-modal>
            <b-modal
                ref="editCategoryModal"
                hide-footer
                title="Form Edit Category"
            >
                <form v-on:submit.prevent="updateCategory">
                    <div class="form-group">
                        <label for="name">Enter Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            v-model="editCategoryData.name"
                            aria-describedby="categoryName"
                            placeholder="Enter your category name"
                        />
                        <div class="invalid-feedback" v-if="errors.name">
                            {{ errors.name[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Chosen an image</label>
                        <div>
                            <img
                                :src="
                                    `${$store.state.serverPath}/storage/${editCategoryData.image}`
                                "
                                ref="editCategoryImageDisplay"
                                width="100%"
                            />
                        </div>
                        <input
                            type="file"
                            v-on:change="editAttachImage"
                            class="form-control"
                            id="image"
                            ref="editCategoryImage"
                        />
                        <div class="invalid-feedback" v-if="errors.image">
                            {{ errors.image[0] }}
                        </div>
                    </div>
                    <hr />
                    <button
                        type="button"
                        class="btn btn-default"
                        v-on:click="hideEditCategoryModal"
                    >
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <span class="fa fa-check"></span> Save
                    </button>
                </form>
            </b-modal>
        </section>
    </div>
</template>

<script>
import * as categoryService from "../services/category_services.js";
export default {
    name: "category",
    data() {
        return {
            categories: [],
            categoryData: {
                name: "",
                image: ""
            },
            editCategoryData: {},
            errors: {}
        };
    },
    mounted() {
        this.loadCategories();
    },
    methods: {
        loadCategories: async function() {
            try {
                const response = await categoryService.loadCategory();
                console.log(response);
                this.categories = response.data.data;
            } catch (error) {
                this.flashMessage.error({
                    message: "Some error occurred, please try again",
                    time: 5000
                });
            }
        },
        attachImage() {
            // to use file reader
            this.categoryData.image = this.$refs.newCategoryImage.files[0];
            let reader = new FileReader();
            reader.addEventListener(
                "load",
                function() {
                    this.$refs.newCategoryImageDisplay.src = reader.result;
                }.bind(this),
                false
            );

            reader.readAsDataURL(this.categoryData.image);
        },
        hideNewCategoryModal() {
            this.$refs.newCategoryModal.hide();
        },
        showNewCategoryModal() {
            this.$refs.newCategoryModal.show();
        },
        createCategory: async function() {
            let formData = new FormData();
            formData.append("name", this.categoryData.name);
            formData.append("image", this.categoryData.image);

            try {
                const response = await categoryService.createCategory(formData);
                this.categories.unshift(response.data);
                this.hideNewCategoryModal();
                this.flashMessage.success({
                    title: "Success Create Category",
                    message: "Data category save in databases",
                    time: 50000
                });
                this.categoryData = {
                    name: "",
                    image: ""
                };
            } catch (e) {
                switch (e.response.status) {
                    case 422:
                        this.errors = e.response.data.errors;
                        break;
                    default:
                        this.flashMessage.error({
                            message: "Some error occurred, please try again",
                            time: 5000
                        });
                        break;
                }
            }
        },

        deleteCategory: async function(category) {
            if (
                !window.confirm(
                    `are you sure you want to delete ${category.name}`
                )
            ) {
                return;
            }
            try {
                await categoryService.deleteCategory(category.id);
                this.categories = this.categories.filter(obj => {
                    return obj.id != category.id;
                });
                this.flashMessage.success({
                    message: "Category delete successfully",
                    time: 5000
                });
            } catch (error) {}
        },
        hideEditCategoryModal() {
            this.$refs.editCategoryModal.hide();
        },
        showEditCategoryModal() {
            this.$refs.editCategoryModal.show();
        },
        editCategory(category) {
            this.editCategoryData = { ...category };
            this.showEditCategoryModal();
        },
        editAttachImage() {
            // to use file reader
            this.editCategoryData.image = this.$refs.editCategoryImage.files[0];
            let reader = new FileReader();
            reader.addEventListener(
                "load",
                function() {
                    this.$refs.editCategoryImageDisplay.src = reader.result;
                }.bind(this),
                false
            );

            reader.readAsDataURL(this.editCategoryData.image);
        },
        updateCategory: async function() {
            let formData = new FormData();
            formData.append("name", this.editCategoryData.name);
            formData.append("image", this.editCategoryData.image);
            formData.append("_method", "put");

            try {
                const response = await categoryService.updateCategory(
                    this.editCategoryData.id,
                    formData
                );
                this.categories.map(category => {
                    if (category.id == response.data.id)
                        category = response.data;
                });
                this.hideEditCategoryModal();
                this.flashMessage.success({
                    title: "Success Edit Category",
                    message: "Data category save in databases",
                    time: 50000
                });
            } catch (e) {
                switch (e.response.status) {
                    case 422:
                        this.errors = e.response.data.errors;
                        break;
                    default:
                        this.flashMessage.error({
                            message: e.response.data.message,
                            time: 5000
                        });
                        break;
                }
            }
        }
    }
};
</script>
