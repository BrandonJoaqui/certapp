<template>
     <div class="indexmodeltable-model-actions btn-group" >
        <a 
            :href="resources_url+'/'+el_id+'/edit'"
            class="btn btn-sm btn-primary"
        >
            <i class="fas fa-pencil-alt"></i>
        </a>
        <a 
            v-if="viewbutton"
            :href="resources_url+'/'+el_id"
            class="btn btn-sm btn-info"
        >
            <i class="fas fa-eye"></i>
        </a>
        <form ref="delform" method="post" :action="resources_url+'/'+el_id" >
            <input type="hidden" name="_method" value="DELETE">
            <slot></slot>
        </form>
        <button 
            v-on:click="submitForm()" 
            class="btn btn-sm btn-danger"
        >
            <i class="fas fa-trash-alt"></i>
        </button>
        
    </div>
</template>
<script>
     export default {
        props:{
            el_id:String,
            viewbutton: {
                type: Boolean,
                default: false,
            },
            resources_url:String,
        },
        mounted(){
        },
        methods:{
           submitForm(){
               if( confirm("La siguiente operación no se puede deshacer. ¿Desea realmente eliminar este elemento?")){
                    this.$refs.delform.submit();
               }
           }
        },
        data(){
            return {
            };
        }
    }
</script>