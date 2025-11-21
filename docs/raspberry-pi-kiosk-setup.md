# Raspberry Pi Kiosk Mode Setup Guide

This guide explains how to set up a Raspberry Pi to boot directly into the Mobius Smart Bin screen in full-screen Kiosk mode.

## Prerequisites
- Raspberry Pi (3B+ or 4 recommended)
- MicroSD card (8GB+)
- Touch screen monitor
- Internet connection

## 1. OS Installation
1. Download **Raspberry Pi Imager**.
2. Choose OS: **Raspberry Pi OS with desktop** (Debian Bookworm or Bullseye).
   *Note: "Lite" version is harder to set up for GUI apps.*
3. In settings (gear icon), configure:
   - Hostname: `mobius-bin-01`
   - Enable SSH (optional, for remote management)
   - Set username/password
   - Configure Wireless LAN

## 2. System Configuration
Boot the Pi and open a terminal.

1. **Update System:**
   ```bash
   sudo apt update && sudo apt full-upgrade -y
   ```

2. **Enable Auto-Login:**
   - Run `sudo raspi-config`
   - Go to `1 System Options` -> `S5 Boot / Auto Login`
   - Select `B4 Desktop Autologin`
   - Finish and Reboot

3. **Install Utilities:**
   ```bash
   sudo apt install -y unclutter sed
   ```
   *`unclutter` hides the mouse cursor when idle.*

## 3. Configure Kiosk Mode (Wayland - Bookworm)
*If using the latest Raspberry Pi OS (Bookworm), it uses Wayland by default.*

1. **Edit the Wayfire configuration:**
   ```bash
   nano ~/.config/wayfire.ini
   ```
   Add these lines to the end if not present (to prevent screen sleep):
   ```ini
   [idle]
   dpms_timeout = 0
   ```

2. **Create an Autostart Entry:**
   Create a file at `~/.config/autostart/kiosk.desktop`:
   ```bash
   mkdir -p ~/.config/autostart
   nano ~/.config/autostart/kiosk.desktop
   ```
   Paste the following:
   ```ini
   [Desktop Entry]
   Type=Application
   Name=Kiosk
   Exec=chromium-browser --kiosk --noerrdialogs --disable-infobars --no-first-run --overscroll-history-navigation=0 --check-for-update-interval=31536000 "http://YOUR_LARAVEL_APP_URL/bin/screen/BIN_ID"
   X-GNOME-Autostart-enabled=true
   ```
   *Replace `YOUR_LARAVEL_APP_URL` and `BIN_ID` with your actual values.*

## 4. Configure Kiosk Mode (X11 - Bullseye/Legacy)
*If using an older OS or if you switched back to X11.*

1. **Edit Autostart:**
   ```bash
   sudo nano /etc/xdg/lxsession/LXDE-pi/autostart
   ```

2. **Replace contents with:**
   ```bash
   @lxpanel --profile LXDE-pi
   @pcmanfm --desktop --profile LXDE-pi
   @xscreensaver -no-splash
   
   # Disable screen sleep
   @xset s off
   @xset -dpms
   @xset s noblank
   
   # Hide cursor
   @unclutter -idle 0.1
   
   # Launch Chromium in Kiosk Mode
   @chromium-browser --kiosk --noerrdialogs --disable-infobars --no-first-run --overscroll-history-navigation=0 --check-for-update-interval=31536000 "http://YOUR_LARAVEL_APP_URL/bin/screen/BIN_ID"
   ```

## 5. Additional Tips

### Hide Mouse Cursor
If the cursor is still visible, ensure `unclutter` is running. In the autostart file (step 3 or 4), make sure `@unclutter -idle 0.1` is present.

### Rotate Screen (If needed)
If your touch screen is mounted vertically:
- **Bookworm (Wayland):** Use the "Screen Configuration" tool in the desktop menu.
- **Bullseye (X11):** Edit `/boot/config.txt` and add `display_rotate=1` (90 degrees) or `display_rotate=3` (270 degrees).

### Remote Management
It is highly recommended to install a remote access tool like **VNC** or **TeamViewer** to manage the Pi without a keyboard/mouse attached.
- Enable VNC: `sudo raspi-config` -> `Interface Options` -> `VNC`.

## 6. Testing
Reboot the Pi (`sudo reboot`). It should boot up, log in automatically, and launch Chromium in full screen with your Mobius Bin Screen loaded.
