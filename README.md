Multiple models authentication
============================

models/Authentication class provides an authentication layer for sub-models. This class implements yii's IdentityInterface, so this solution is based on native yii2 authentication layer.

models/AsUser and models/User models implements interface AuthenticableModel. This interface provides ability to make any model authenticable. List of available models is described in Authentication class.

controllers/AdminController contain custom AccessControll behavior with some access restriction by roles

components/AccessControll - it's just an extended class of yii's AccessControll, but it linked with a custom AccessRule.

models/LoginForm - there are $allowedRoles param in constructor. This param allows to restrict user roles, which can be authenticated via this form. Also there are a special condition for authentication with pid param.
