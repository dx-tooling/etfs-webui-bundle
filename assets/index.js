import { MainNavigationController } from "./controllers/MainNavigationController.js";

const bootstrap = (stimulusApp) => {
    stimulusApp.register("webuiMainNavigation", MainNavigationController);
};

export { bootstrap as webuiBootstrap };
