<template>
    <form class="indexmodeltable-simplesearchbar" >
        <div class="input-group mb-3">
            <input 
                type="text" 
                        name="s" 
                        class="form-control form-control-sm" 
                        :value="default_val"
                >
            <div  class="input-group-append">

                <button class="btn btn-outline-secondary btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div >
        </div>
    </form> 
</template>
<script>
     export default {
        props:{
            default_val:String,
        },
        mounted(){
        },
        methods:{
           
        },
        data(){
            return {
            };
        }
    }
</script>