<template>
    <div class="consulta-certificado">

        <div class="form-floating">
            <select 
                class="form-select" 
                id="floatingSelect" 
                v-model="tipoDeConsulta" 
            >
                <option value="consecutivo" >CÓDIGO DE CERTIFICACIÓN</option>
                <option value="persona" >PERSONA</option>
                <option value="equipo"  >EQUIPO</option>
            </select>
            <label for="floatingSelect">Tipo de consulta</label>
        </div>

        <div 
            v-if="tipoDeConsulta == 'consecutivo'" 
            class="form-floating mt-2"
        >
            <input 
                type="text" 
                class="form-control" 
                id="floatingInputValue2"
                v-model="consecutivo"
            >
            <label for="floatingInputValue2">Código del certificado o carné</label>
        </div>

        <div v-if="tipoDeConsulta == 'persona'" >
            <div class="form-floating mt-2">
                <select 
                    class="form-select" 
                    id="floatingSelect" 
                    v-model="tipo_de_documento" 
                >
                        <option >CC</option>
                        <option>CE</option>
                        <option>PPT</option>
                        <option>PASAPORTE</option>
                </select>
                <label for="floatingSelect">Tipo de documento</label>
            </div>

            <div class="form-floating mt-2">
                <input 
                    type="text" 
                    class="form-control" 
                    id="floatingInputValue1"
                    v-model="nid"
                >
                <label for="floatingInputValue1">Número de identificación</label>
            </div>
        </div>



        <div 
            v-if="tipoDeConsulta == 'equipo'" 
            class="form-floating mt-2"
        >
            <input 
                type="text" 
                class="form-control" 
                id="floatingInputValue2"
                v-model="placaSerie"
            >
            <label for="floatingInputValue2">Número de placa o serie</label>
        </div>
        <div class="my-3" v-if="!hideSlot" ><slot></slot></div>
        <div class="text-center mt-3" >
            <a class="btn btn-primary" :href="obtenerUrl()">Consultar</a>
        </div>
    </div>
</template>
<script>
     export default {
        props:{
        
        },
        mounted(){
            let that = this;
            setTimeout(() => {
                that.hideSlot = true;
            }, 2500);
        },
        methods:{
            obtenerUrl(){
                return "/consulta_certificados?"+
                "tipo_de_consulta=" + this.tipoDeConsulta + "&" +
                "tipo_de_documento=" + this.tipo_de_documento + "&" +
                "nid=" + this.nid + "&" +
                "consecutivo=" + this.consecutivo + "&" +
                "placa_serie=" + this.placaSerie;
            }
        },
        watch: {
           
        },
        data(){
            return {
                tipoDeConsulta: "consecutivo",
                consecutivo:"",
                tipo_de_documento:"CC",
                nid:"",
                placaSerie:"",
                hideSlot: false,
            }
        }
    }
</script>