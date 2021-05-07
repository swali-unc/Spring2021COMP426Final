export default class comp426twitter {
	constructor() {
		this.hasError = false;
		this.errorMsg = '';
		this.errorCallbacks = [];
	}

	async getIndex(skip,limit) {
		if( skip == undefined && limit == undefined ) {
			return await this.axiosReq({
				method: 'get',
				url: 'https://comp426-1fa20.cs.unc.edu/a09/tweets',
				withCredentials: true,
			});
		}

		if( limit == undefined ) limit = 50;
		if( skip == undefined ) skip = 0;
		
		return await this.axiosReq({
			method: 'get',
			url: `https://comp426-1fa20.cs.unc.edu/a09/tweets?skip=${skip}&limit=${limit}`,
			withCredentials: true,
		});
	}

	async createTweet( tweetbody ) {
		return this.axiosReq({
			method: 'post',
			url: 'https://comp426-1fa20.cs.unc.edu/a09/tweets',
			withCredentials: true,
			data: {
				body: tweetbody
			},
		});
	}

	async getTweet( tweetid ) {
		return this.axiosReq({
			method: 'get',
			url: `https://comp426-1fa20.cs.unc.edu/a09/tweets/${tweetid}`,
			withCredentials: true,
		});
	}

	async updateTweet( tweetid, tweetbody ) {
		return this.axiosReq({
			method: 'put',
			url: `https://comp426-1fa20.cs.unc.edu/a09/tweets/${tweetid}`,
			withCredentials: true,
			data: {
				body: tweetbody
			},
		});
	}

	async destroyTweet( tweetid ) {
		return this.axiosReq({
			method: 'delete',
			url: `https://comp426-1fa20.cs.unc.edu/a09/tweets/${tweetid}`,
			withCredentials: true,
		});
	}

	async likeTweet( tweetid ) {
		return this.axiosReq({
			method: 'put',
			url: `https://comp426-1fa20.cs.unc.edu/a09/tweets/${tweetid}/like`,
			withCredentials: true,
		});
	}

	async unlikeTweet( tweetid ) {
		return this.axiosReq({
			method: 'put',
			url: `https://comp426-1fa20.cs.unc.edu/a09/tweets/${tweetid}/unlike`,
			withCredentials: true,
		});
	}

	async replyTweet( tweetid, tweetbody ) {
		return this.axiosReq({
			method: 'post',
			url: 'https://comp426-1fa20.cs.unc.edu/a09/tweets',
			withCredentials: true,
			data: {
				"type": "reply",
				"parent": tweetid,
				"body": tweetbody
			}
		});
	}

	async retweet( tweetid, tweetbody ) {
		return this.axiosReq({
			method: 'post',
			url: 'https://comp426-1fa20.cs.unc.edu/a09/tweets',
			withCredentials: true,
			data: {
				"type": "retweet",
				"parent": tweetid,
				"body": tweetbody
			}
		});
	}

	async axiosReq( params ) {
		try {
			const result = await axios(params);
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