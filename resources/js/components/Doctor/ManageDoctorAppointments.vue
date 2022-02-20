<template>
	<div>
    <div class="container">
        <div class="row" v-if="$gate.isDoctor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    	Manage Appointments
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
													<thead>
														<tr>
															<th scope="col">Doctor</th>
															<th scope="col">Booked By</th>
															<th scope="col">Email</th>
															<th scope="col">Date</th>
															<th scope="col">Time</th>
															<th scope="col">Reason</th>
															<th scope="col">Status</th>
															<th scope="col">Token</th>
															<th scope="col">Change</th>
														</tr>
													</thead>
													<tbody>
														<tr v-for="a in appointments" :key="a.id">
															<td>{{a.doctor_name}}</td>
															<td>{{a.name}}</td>
															<td>{{a.email}}</td>
															<td>{{a.date}}</td>
															<td>{{a.time}}</td>
															<td>{{a.reason}}</td>
															<td>{{a.status}}</td>
															<td>{{a.token}}</td>
															<td>
																<button class="btn btn-secondary" @click="changePrompt(a)" v-if="a.status == 'Requested' || a.status == 'Confirmed'"><i class="fa fa-cog"></i> Change</button>
																<button class="btn btn-success" @click="changeAP(a.id, 'Confirmed')" v-if="a.status=='Requested'"><i class="fa fa-check"></i> Confirm</button>
																<button class="btn btn-danger" @click="changeAP(a.id, 'Declined')"  v-if="a.status=='Requested' || a.status=='Confirmed'"><i class="fa fa-times"></i> Decline</button>
																<button class="btn btn-success" @click="changeAP(a.id, 'Completed')" v-if="a.status=='Confirmed'"><i class="fa fa-check"></i> Completed</button>
																<button class="btn btn-danger" @click="reports(a.id)" v-if="a.status=='Completed'"><i class="fa fa-file"></i> Reports</button>
															</td>
														</tr>
													</tbody>
													<tfoot>
														<pagination :pagination="pagination"
														 	@prev="getAppointments(pagination.prevPageUrl)"
															@next="getAppointments(pagination.nextPageUrl)"
														></pagination>
													</tfoot>
												</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="addModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
				    <h5 class="modal-title">Edit Appointment</h5>
				    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
				      <span aria-hidden="true">&times;</span>
				    </button>
				  </div>
				  <div class="modal-body">
				  	<!-- Only doctor and timings can be changed -->
				  	<form @submit.prevent="updateAppointment" @keydown="form.onKeydown($event)">
							<div :class="['form-group', errors.name ? 'has-error' : '']">
								<label>Name:</label>
								<input type="text" class="form-control" placeholder="Enter the name" v-model="form.name" disabled>
								<span v-if="errors.name" :class="['badge bg-danger']">Please enter a valid character.</span>
							</div>
							<div :class="['form-group', errors.email ? 'has-error' : '']">
								<label>Email:</label>
								<input type="email" class="form-control" placeholder="Enter the email" v-model="form.email" disabled>
								<span v-if="errors.email" :class="['badge bg-danger']">Please enter a valid email.</span>
							</div>
							<div :class="['form-group', errors.date ? 'has-error' : '']">
								<label>Date:</label>
								<input type="date" class="form-control" placeholder="Enter the date" v-model="form.date">
								<span v-if="errors.date" :class="['badge bg-danger']">Please enter a valid date.</span>
							</div>
							<div :class="['form-group', errors.time ? 'has-error' : '']">
								<label>Time:</label>
								<input type="time" class="form-control" placeholder="Enter the time" v-model="form.time" step="60">
								<span v-if="errors.time" :class="['badge bg-danger']">Please enter a valid time.</span>
							</div>
							<div :class="['form-group', errors.reason ? 'has-error' : '']">
								<label>Reason:</label>
								<input type="text" class="form-control" placeholder="Enter the reason" v-model="form.reason">
								<span v-if="errors.reason" :class="['badge bg-danger']">Please enter a valid reason.</span>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" type="submit">Update</button>
							</div>
						</form>
				  </div>
				  <div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				  </div>
				</div>
			</div>
		</div>
		<div v-if="!$gate.isDoctor()">
			<denied></denied>
		</div>
	</div>
</template>

<script>
		import Pagination from '../pagination.vue';
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        
        components: {pagination:Pagination},
        
        created(){
        	this.getAppointments();;
        },
        
        data(){
        	return{
        		pagination: {
          		lastPage: '',
           		currentPage: '',
            	total: '',
            	lastPageUrl: '',
            	nextPageUrl: '',
            	prevPageUrl: '',
            	from: '',
            	to: '',
         		},
         		
         		form: new Form({
         			doctor: '',
         			date: '',
         			time: '',
         			id: '',
         			booked_by: '',
         			name: '',
         			email: '',
         			reason: ''
         		}),
         		
         		appointments: [],
         		errors: []
        	}
        },
        
        methods: {
        	changePrompt(a){
        		this.form.fill(a);
        		$("#addModal").modal("show");
        	},
        	
        	getAppointments(url = "/getDocAppointments"){
        		axios.post(url)
        		.then(response => {
        			this.appointments = response.data.data.data;
        			this.configPagination = response.data.data;
        		});
        	},
        	
        	updateAppointment(){
        		this.form.post("/updateDocAppointment")
        			.then(response => {
        				if(response.data == 200){
        					toast.fire({
        						icon: 'success',
        						title: 'Appointment Updated'
        					});
        					this.form.reset();
        					$("#addModal").modal('hide');
        					this.errors = [];
        					this.getAppointments();
        				}
        			})
        			.catch((errors) => {
        				this.errors = errors.response.data.errors;
        			})
        	},
        	
        	changeAP(id, status){
        		axios.post("/changeAppointment", {id: id, status: status})
        		.then(response => {
        			if(response.data == 200){
        				toast.fire({
        					icon: 'success',
        					title: 'Appointment Updated'
        				});
        				this.getAppointments();
        			}
        		})
        	},
        	
        	reports(id){
        		this.$router.push('/doctor/reports/'+id);
        	}
        }
    }
</script>
