import User from "../models/User.js";
import Parking from "../models/Parking.js";

const associations = () => {
  User.hasMany(Parking, { foreignKey: "userId" });
  Parking.belongsTo(User, { foreignKey: "userId" });
};

export default associations;
