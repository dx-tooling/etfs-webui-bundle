import { Controller } from "@hotwired/stimulus";
import { enter, leave } from "../utils/el-transition.js";

export class MainNavigationController extends Controller {
    static targets = ["mainNavigationSmallViewportOutermostContainer", "dropdownMenu", "dropdownToggleButtonIcon"];

    static values = {
        isOpen: { type: Boolean, default: false },
        dropdownOpen: { type: Boolean, default: false },
    };

    connect() {
        document.addEventListener("click", this.handleClickOutside.bind(this));
    }

    disconnect() {
        document.removeEventListener("click", this.handleClickOutside.bind(this));
    }

    async toggleMobileSidebar(event) {
        // Prevent default and stop propagation
        event.preventDefault();
        event.stopPropagation();

        const target = this.mainNavigationSmallViewportOutermostContainerTarget;
        if (!target) return;

        if (this.isOpenValue) {
            await this.closeMobileSidebar();
        } else {
            await this.openMobileSidebar();
        }
    }

    async openMobileSidebar() {
        const target = this.mainNavigationSmallViewportOutermostContainerTarget;
        if (target) {
            this.isOpenValue = true;
            await enter(target);
        }
    }

    async closeMobileSidebar() {
        const target = this.mainNavigationSmallViewportOutermostContainerTarget;
        if (target) {
            this.isOpenValue = false;
            await leave(target);
        }
    }

    toggleDropdownMenu(event) {
        event.preventDefault();
        event.stopPropagation();

        if (this.hasDropdownMenuTarget) {
            this.dropdownMenuTarget.classList.toggle("hidden");
            this.dropdownOpenValue = !this.dropdownMenuTarget.classList.contains("hidden");
        }
    }

    handleClickOutside(event) {
        // If clicking on a toggle button, ignore
        const toggleButtonClick =
            event.target.closest('[data-action*="webuiMainNavigation#toggleMobileSidebar"]') ||
            event.target.closest('[data-action*="webuiMainNavigation#toggleDropdownMenu"]');
        if (toggleButtonClick) {
            return;
        }

        // Handle large viewport dropdown
        if (this.hasDropdownMenuTarget && this.dropdownOpenValue) {
            if (!this.dropdownMenuTarget.contains(event.target)) {
                this.dropdownMenuTarget.classList.add("hidden");
                this.dropdownOpenValue = false;
            }
        }

        // Handle small viewport navigation (both fullcontent and appshell)
        if (this.hasMainNavigationSmallViewportOutermostContainerTarget && this.isOpenValue) {
            const container = this.mainNavigationSmallViewportOutermostContainerTarget;

            // Get the content div (the dropdown menu itself)
            const contentDiv = container.querySelector(".absolute");

            // If click is outside the dropdown content, close it
            if (!contentDiv || !contentDiv.contains(event.target)) {
                this.closeMobileSidebar();
            }
        }
    }

    dropdownOpenValueChanged(value) {
        if (this.hasDropdownToggleButtonIconTargets) {
            this.dropdownToggleButtonIconTargets[0].classList.toggle("hidden", value);
            this.dropdownToggleButtonIconTargets[1].classList.toggle("hidden", !value);
        }
    }
}
