<template>
    <div class="vueforms-buttonsedit-actions my-4 text-center" >
        <a :href="back_url" class="btn btn-sm btn-danger" >
            <i class="fas fa-arrow-left"></i> 
            Volver atrás
        </a>
        <a :href="currentLocation" class="btn btn-sm btn-warning" >
            <i class="fas fa-undo"></i>
            Cancelar
        </a>
        <button type="submit" class="btn btn-sm btn-success">
            <i class="fas fa-save"></i>
            Guardar 
        </button>
    </div> 
</template>
<script>
     export default {
        props:{
            back_url:String,
        },
        mounted(){
        },
        methods:{
           
        },
        data(){
            return {
                currentLocation: window.location.href,
            };
        }
    }
</script>