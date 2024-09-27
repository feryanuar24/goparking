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

    if (parkingEntry.userId !== req.user.id) {
      return res
        .status(403)
        .json({ message: "Not allowed to update this parking entry" });
    }

    const { vehicleType, entryTime } = parkingEntry;
    const exitTime = new Date();
    const hoursParked = Math.ceil(
      (exitTime - new Date(entryTime)) / (1000 * 60 * 60)
    );

    let parkingFee;
    switch (vehicleType) {
      case "Car":
        parkingFee = hoursParked * 5000;
        break;
      case "Motorcycle":
        parkingFee = hoursParked * 2000;
        break;
      default:
        return res.status(400).json({ message: "Invalid vehicle type" });
    }

    await parkingEntry.update({ parkingFee, exitTime });

    res.status(200).json({ message: "Parking entry updated", parkingEntry });
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
