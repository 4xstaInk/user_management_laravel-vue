<template>
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <h3>
                    <button
                        class="btn btn-sm btn-outline-primary mr-3"
                        @click="$emit('view-dashboard')"
                    >
                        <i class="fas fa-chevron-left"></i> Back</button
                    >To Do List
                </h3>
                <hr />
                <div class="card-body">
                    <br />

                    <form>
                        <div class="input-group mb-3">
                            <input
                                type="text"
                                class="form-control"
                                id="taskInput"
                                v-model="item.name"
                                placeholder="Enter your Task here..."
                                value=""
                            />
                            <div class="input-group-append">
                                <button
                                    class="btn btn-primary"
                                    type="button"
                                    @click="addItem()"
                                    
                                >
                                    <i class="fas fa-plus"></i> Task
                                </button>
                                <button class="btn btn-warning" type="reset">
                                    <i class="fas fa-eraser"></i> Clear
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <TaskView>
        </TaskView>
    </div>
</template>

<script>
import TaskView from '../tasks/TaskView.vue';

export default {

    components:{
        TaskView
    },

    data: function() {
        return {
            item: {
                name: ""
            }
        };
    },
    methods: {
        addItem() {
           if (this.item.name == "") {
                return;
            }
            axios
                .post("users/items", {
                    item: this.item
                })
                .then(response => {
                    if (response.status == 201) {
                        this.item.name == "";
                    }

                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
