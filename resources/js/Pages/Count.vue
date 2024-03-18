<script setup>
    import { reactive, ref } from "vue";
    const message = ref("HELLO VUE 3");
    const count = reactive({ number:0 });
    function updateMessage(){
        message.value = "HELLO WORLD UPDATED!!!";
        count.number = 90;
    }
</script>

<template>
    <h1>{{ message }}, {{ count.number }}</h1>
    <div class="container">
        <button class="p-2 text-lg text-blue bg-gray-500 rounded-lg " 
            @click="updateMessage"> 
            Click me!
        </button>
    </div>
</template>
<style>
    .container {
        display: flex;
        flex-direction: column;
        justify-content: center; /* Center vertically */
        align-items: center; /* Center horizontally */
        
    }
    h1 
    {
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        margin-top: 30px;
    }
    button 
    {
        background-color:deeppink;
        color: blanchedalmond;
    }

</style>