<template>
<div>
    <NavBar />
    <router-view />
</div>
  
</template>

<script>
import NavBar from '../js/components/NavBar';
export default {
    name:'App',
    components:{
        NavBar
    }

}
</script>

<style>

</style>