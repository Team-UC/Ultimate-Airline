import React from "react";
import {
  FaFacebookF,
  FaKey,
  FaLock,
  FaTiktok,
  FaYoutube,
} from "react-icons/fa";
import { FaXTwitter } from "react-icons/fa6";
import { IoLogoInstagram } from "react-icons/io";

const HeaderLink = () => {
  return (
    <div className="flex items-center justify-between px-20 bg-black ">
      <div className="flex items-center space-x-4">
        <FaFacebookF className="text-white" />
        <IoLogoInstagram className="text-white" />
        <FaTiktok className="text-white" />
        <FaYoutube className="text-white" />
        <FaXTwitter className="text-white" />
      </div>
      <div className="flex items-center space-x-4">
        <div className="flex items-center space-x-2">
          <FaKey className="text-white" />
          <span className="text-white">Login</span>
        </div>
        <div className="flex items-center space-x-2 bg-orange-700 w-26 h-full justify-center p-2">
          <FaLock className="text-white" />
          <span className="text-white">Sign Up</span>
        </div>
      </div>
    </div>
  );
};

export default HeaderLink;
