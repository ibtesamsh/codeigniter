import { Router } from "express";
import auth from "../Auth.js";

import { login, registerUser,logout,dashboard,editUser,deleteUser } from "../controller/userControllere.js";
const router = Router()
router.route("/login").post(login)
router.route("/register").post(registerUser)
router.route("/logout").post(auth,logout)
router.route("/dashboard").get(auth,dashboard)
router.route("/edit").post(editUser)
router.route("/delete/:id").delete(auth,deleteUser)
// router.route("/deletee/:userId").post(auth,deleteUsers)
export default router