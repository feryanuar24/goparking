import Parking from "../models/Parking.js";

export const createParkingEntry = async (req, res) => {
  try {
    const { vehicleNumber, vehicleType } = req.body;

    if (!["Car", "Motorcycle"].includes(vehicleType)) {
      return res.status(400).json({ message: "Invalid vehicle type" });
    }

    const newParkingEntry = await Parking.create({
      vehicleNumber,
      vehicleType,
      userId: req.user.id,
    });
    res.status(201).json(newParkingEntry);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
};

export const exitParking = async (req, res) => {
  try {
    const { id: parkingId } = req.params;
    const parkingEntry = await Parking.findByPk(parkingId);

    if (!parkingEntry) {
      return res.status(404).json({ message: "Parking entry not found" });
    }

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

    if (parkingEntry.userId !== req.user.id) {
      return res
        .status(403)
        .json({ message: "Not allowed to update this parking entry" });
    }

    await Parking.update(
      {
        parkingFee,
        exitTime,
      },
      {
        where: {
          id: parkingId,
        },
      }
    );

    const updatedParking = await Parking.findByPk(parkingId);
    res.status(200).json({ message: "Parking entry updated", updatedParking });
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
};

export const getAllParkedVehicles = async (_req, res) => {
  try {
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
