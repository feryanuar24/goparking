import express from "express";
import {
  createParkingEntry,
  exitParking,
  getAllParkedVehicles,
} from "../controllers/parkingController.js";
import { verifyToken } from "../controllers/authController.js";

const router = express.Router();

router.post("/park", verifyToken, createParkingEntry);
router.put("/exit/:id", verifyToken, exitParking);
router.get("/vehicles", verifyToken, getAllParkedVehicles);

export default router;
