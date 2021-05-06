export default class fightapi {
	constructor() {
		this.hasError = false;
		this.errorMsg = '';
		this.errorCallbacks = [];
	}
	
	async getStatus() {
		return await this.axiosReq({
			method: 'get',
			url: '/play/status'
		});
	}
	
	async finish() {
		return await this.axiosReq({
			method: 'get',
			url: '/play/finish'
		});
	}
	
	async move( index ) {
		return await this.axiosReq({
			method: 'get',
			url: '/play/move/' + index
		});
	}
	
	async axiosReq( params ) {
		try {
			const result = await axios(params);
			if( result.data.error == true ) {
				this.hasError = true;
				this.errorMsg = 'API error has occured';
				this.doErrorCallback();
				return;
			}
			return result;
		} catch( error ) {
			this.hasError = true;
			this.errorMsg = error.message;
			this.doErrorCallback();
		}
	}
	
	addErrorCallback(callback) {
		this.errorCallbacks.push(callback);
	}

	doErrorCallback() {
		this.errorCallbacks.forEach( (cv) => cv(this.errorMsg) );
	}
}