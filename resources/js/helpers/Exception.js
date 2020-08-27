import User from './User';

class Exception {
    handle(error) {
        console.log('the error is ', error)
        if(error.status === 'Token is Invalid'){
            User.logOut()
        }
        this.isExipred(error.response.data.error);
    }

    isExipred(error) {
        if (error === "Token is invalid") {
            User.logout();
        }
    }
}

export default new Exception();
