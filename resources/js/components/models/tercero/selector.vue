<template>
    <div class="tercero-selector">
        <label class="form-label" >
            {{caption_text}} 
        </label>

        <div 
            v-if="terceroValidado" 
            class="text-info text-sm"
        >Actual: {{terceroValidado.id}} - {{terceroValidado.nombres}} {{terceroValidado.apellidos}}</div>

        <div class="position-relative">
            <input
                class="form-control" 
                type="text"
                :placeholder="placeholder_text"
                v-model="inputSearch"
                v-on:input="onInputFocus()"
                @click="onInputClick()"
                @blur="hideSearchOptions()"
                autocomplete="off"
                :required="required == 'required' ? true : false"
            >
            <input type="hidden" :name="input_name" v-model="selectedInputId" />
            
            <div
                v-if="search_enabled"
                class="position-absolute bg-white shadow autocomplete-box"
            >
                <ul>
                    <li v-for="tercero in terceros" 
                        @click="SetInputValue(tercero)"
                        @mouseover="lockInputBlur = true"
                        @mouseleave="lockInputBlur = false"
                        class="cursor-pointer hover:bg-blue-200 p-2" 
                    >
                        {{tercero.id}} -  {{tercero.nombres}} {{tercero.apellidos}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
     export default {
        props:{
            caption_text:String,
            current_value:String,
            placeholder_text:String,
            required:String,
            input_name:String,
            value:Object,
        },
        mounted(){
            let that = this;
            if(that.current_value){
                this.seleccionarPorId(that.current_value);
            }
        },
        methods:{
            seleccionarPorId(id){
                this.selectedInputId = id;
                this.validateCurrentValue();
            },
           searchTerm: function(){
                let that = this;
                fetch('/terceros?' 
                + new URLSearchParams({
                    s: that.inputSearch
                }),
                {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                })
                .then(response => response.json())
                .then(function(jsonResponse){
                    that.terceros = jsonResponse.data;
                })
                .catch(err => console.log('Solicitud fállida', err)); 
            
            },
           onInputClick(){
               this.inputSearch = ""; 
               this.onInputFocus();
           },
           onInputFocus: function(){
               this.search_enabled = true;
               this.lockInputBlur = false;
               this.terceroValidado = false;
               this.selectedInputId = "";
               this.searchTerm();
           },
           hideSearchOptions: function(){
               if(this.lockInputBlur){return;}
               this.search_enabled = false;
               this.validateCurrentValue();
           },
           SetInputValue: function(empresa){
                this.selectedInputId = empresa.id;
                this.lockInputBlur = false;
                this.search_enabled = false;
                this.validateCurrentValue();
           },
           validateCurrentValue: function(){
                let that = this;
                if(!that.selectedInputId){
                    that.inputSearch = ""; 
                    that.selectedInputId = "";
                    return;
                }

                fetch('/terceros/'+that.selectedInputId,{
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                })
                .then(response => response.json())
                .then(function(response){
                    if(!response){ 
                        that.inputSearch = ""; 
                        that.selectedInputId = "";
                        alert("Seleccione o escriba una tercero válido");
                    }else{
                        that.terceroValidado = response?response:false;
                        that.inputSearch = that.terceroValidado.id + " - " 
                                            + that.terceroValidado.nombres 
                                            + " " + that.terceroValidado.apellidos;
                        if (that.terceroValidado) {
                            that.$emit('input', that.terceroValidado);
                        } 
                    }
                })
                .catch(err => console.log('Solicitud fállida', err));
                
           },
        },
        watch: {
            value: {
                deep: true,
                handler(){
                    if(!this.value.id){
                        this.selectedInputId = "";
                        this.terceroValidado = false;
                        this.validateCurrentValue(); 
                    }
                }
            }
        },
        data(){
            return {
                terceros:[],
                inputSearch:"",
                search_enabled:false,
                lockInputBlur:false,
                terceroValidado:false,
                selectedInputId:"",
            };
        }
    }
</script>