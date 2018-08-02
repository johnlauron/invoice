<template>
	<div class="button-generate" >
		<div class="button">
            <input type="text" name="form_name" class="form-control button" placeholder="Name of Form" required><br>
			<input type="button" class="btn btn-success" v-on:click="click" style="margin-bottom: 7px;" value="Generate Box"></input><br>
            <button class="btn btn-primary" style="min-width: 101px;">Save</button>
		</div>
		<div v-for="item in items" :key="item.Id" style="list-style-type: none;">
	        <vuedragresize :w="150" :h="30" :x="146" :y="153"></vuedragresize>
	    </div>
	</div>
</template>
<script>
	import vuedraggableresizable from '../components/vue-draggable-resizable.vue';
	export default {
        mounted() {
            console.log('Component mounted.')
        },
        data: function(){
        	return{
        		Id: '',
        		items: []
        	}
        },
        methods: {
        	click: function(){
        		this.Id++,
        		this.items.push({
        			id: this.Id++
        		})
        	}
        },
        components: {
        	'vuedragresize': vuedraggableresizable
        }
    }
</script>