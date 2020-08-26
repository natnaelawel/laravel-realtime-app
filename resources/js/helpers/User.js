import Token from './Token';
import AppStorage from './AppStorage';
class User{
    login(formData){
        axios.post('api/auth/login', formData)
        .then(res =>{
            this.responseAfterLogin(res.data);
            Token.payload(res.data.token);
            window.location = '/';

        })
        .catch(error => console.log(error.response.data));
    }
    responseAfterLogin({user,token}){
        if(Token.isValid(token)){
            AppStorage.store(user, token);

        }
    }
    hasToken(){
        const storedToken = AppStorage.getToken();
        if(storedToken){
            return Token.isValid(storedToken) ? true : false;
        }
        return false;
    }

    loggedIn(){
        return this.hasToken();
    }
    logOut(){
        AppStorage.clear();
        window.location = '/login';

    }

    name(){
        if(this.loggedIn())
        return AppStorage.getUser();
    }
    id(){
        if(this.loggedIn()){
            const payload = Token.payload(AppStorage.getToken());
            return payload.sub;
        }
    }

    own(id) {
        return this.id() == id;
    }

    admin() {
        return this.id() == 1;
    }
}

export default new User();
