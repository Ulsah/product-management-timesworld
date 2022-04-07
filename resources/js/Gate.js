export default class Gate{
	constructor(user){
		this.user = user; // Sets user data into this.user
	}
	
	isAdmin(){
  	return this.user.type === 'Admin'; // Checks user type and returns true or false
  }
}
