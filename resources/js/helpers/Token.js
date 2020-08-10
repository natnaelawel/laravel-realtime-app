class Token
{
    isValid(token){
        const payload = this.payload(token);
        if(payload){
            return payload.iss === "http://laravel-realtime-app.test/api/auth/login" ? true : false;
        }
        return false;
    }
    payload(token){
        const payload = token.split('.')[1];

        console.log(this.decode(payload));
        return this.decode(payload);
    }

    decode(payload){
        if(this.isBase64(payload)){
            return JSON.parse(atob(payload));
        }
        return false;
    }

    isBase64(str){
        try{
            return btoa(atob(str)).replace(/=/g,"") == str;
        }
        catch(err){
            return false;
        }
    }
}
export default new Token();
