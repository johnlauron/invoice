<template>
	<div class="button-generate" >
		<div class="button">
			<input type="hidden" name="category_name[]" v-for="item in items" :value="item.category">
			<input type="text" v-model="text" list="films" class="form-control button" placeholder="input/choose category">
			<datalist id="films">
				<option v-for="cats in cat">{{cats}}</option>
			</datalist><br>
			<input type="button" class="btn btn-success" v-on:click="click" style="margin-bottom: 7px;" value="Generate Box"></input><br>
            <button class="btn btn-primary" style="min-width: 101px;">Save</button>
		</div>
		<!-- box-->
		<div v-for="item in items" :key="item.Id" style="list-style-type: none;">
	        <vuedragresize :w="150" :h="30" :x="146" :y="153" placeholder="aws"></vuedragresize>
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
				text: '',
        		items: [],
				cat: []
        	}
        },
        methods: {
        	click: function(){
				if(!this.text){
					alert("Select category first !");
				}else{
					this.Id++,
					this.items.push({
						id: this.Id++,
						category: this.text,
					})
					var one = this.text
					if(this.cat.length === 0){
						this.cat.push(this.text)
					}
					else{
						if(this.cat.includes(this.text)){
							console.log('sakpan')
						}
						else{
							this.cat.push(this.text)
						}
					}
				}
				this.text=''
        	}
        },
        components: {
        	'vuedragresize': vuedraggableresizable
        }
    }
</script>