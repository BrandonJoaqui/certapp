<template>
    <div class="main-app-menu">
       <a v-for="menuItem in menuItems" :href="menuItem.path" ><i :class="menuItem.faicon" aria-hidden="true"></i>&nbsp;&nbsp;{{menuItem.caption}}</a>
    </div>
</template>
<script>
    export default {
        mounted() {
            
        },
        data: function(){
            return {
                menuItems : [
                    {
                        caption: "Terceros",
                        path: "/terceros",
                        faicon: "fa-solid fa-users",
                    },
                    {
                        caption: "Equipos",
                        path: "/equipos",
                        faicon: "fa-solid fa-truck-ramp-box",
                    },
                    {
                        caption: "Competencias",
                        path: "/competencias",
                        faicon: "fa-solid fa-brain",
                    },
                    {
                        caption: "Certificados",
                        path: "/certificados",
                        faicon: "fa-solid fa-file-signature",
                    },
                ],
                };
        },
    }
</script>
