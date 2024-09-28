import { body, validationResult } from "express-validator";
import Parking from "../models/Parking.js";
import { param } from "express-validator";

export const createParkingEntry = [
  body("vehicleNumber").notEmpty().withMessage("Vehicle number is required"),
  body("vehicleType")
    .isIn(["Car", "Motorcycle"])
    .withMessage("Invalid vehicle type"),
  async (req, res) => {
    // Validate request body
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
      return res.status(400).json({ errors: errors.array() });
    }

    try {
      // Create a new parking entry
      const { vehicleNumber, vehicleType } = req.body;
      const newParkingEntry = await Parking.create({
        vehicleNumber,
        vehicleType,
        userId: req.user.id,
      });

      res.status(201).json(newParkingEntry);
    } catch (error) {
      res.status(500).json({ message: error.message });
    }
  },
];

export const exitParking = [
  param("id").isInt().withMessage("Parking ID must be an integer"),
  async (req, res) => {
    // Validate request parameters
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
      return res.status(400).json({ errors: errors.array() });
    }

    try {
      // Find the parking entry by ID
      const { id: parkingId } = req.params;
      const parkingEntry = await Parking.findByPk(parkingId);

      // Check if the parking entry exists
      if (!parkingEntry) {
        return res.status(404).json({ message: "Parking entry not found" });
      }

      // Check if the parking entry belongs to the authenticated user
      if (parkingEntry.userId !== req.user.id) {
        return res
          .status(403)
          .json({ message: "Not allowed to update this parking entry" });
      }

      // Calculate parking fee
      const { vehicleType, entryTime } = parkingEntry;
      const exitTime = new Date();
      const hoursParked = Math.ceil(
        (exitTime - new Date(entryTime)) / (1000 * 60 * 60)
      );
      let parkingFee;

      if (vehicleType === "Car") {
        parkingFee = hoursParked * 5000;
      } else if (vehicleType === "Motorcycle") {
        parkingFee = hoursParked * 2000;
      } else {
        return res.status(400).json({ message: "Invalid vehicle type" });
      }

      // Update the parking entry
      await parkingEntry.update({ parkingFee, exitTime });

      res.status(200).json({ message: "Parking entry updated", parkingEntry });
    } catch (error) {
      res.status(500).json({ message: error.message });
    }
  },
];

export const getAllParkedVehicles = async (_req, res) => {
  try {
    // Find all parked vehicles
    const parkedVehicles = await Parking.findAll({
      where: {
        exitTime: null,
      },
    });

    res.status(200).json(parkedVehicles);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
};
