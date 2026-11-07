import os
import shutil

base_dir = r"d:\old_backend\backend\homewala-backend-pre-develop\homewala-backend-pre-develop"
old_path = os.path.join(base_dir, "public", "assets", "admin", "img", "vendor-photo")
new_path = os.path.join(base_dir, "storage", "app", "public", "vendor_photos")

if os.path.exists(old_path):
    os.makedirs(new_path, exist_ok=True)
    for item in os.listdir(old_path):
        s = os.path.join(old_path, item)
        d = os.path.join(new_path, item)
        if not os.path.exists(d):
            shutil.copy2(s, d)
    print("Migrated vendor-photo to vendor_photos")

def process_file(filepath):
    if not os.path.exists(filepath):
        return
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Replacements for string literals
    new_content = content.replace("assets/admin/img/vendor-photo/", "storage/vendor_photos/")
    new_content = new_content.replace("public_path('assets/admin/img/vendor-photo/')", "storage_path('app/public/vendor_photos/')")
    
    if content != new_content:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Updated {filepath}")

# Process relevant files:
controllers = [
    os.path.join(base_dir, "app", "Http", "Controllers", "BackEnd", "VendorManagementController.php"),
    os.path.join(base_dir, "app", "Http", "Controllers", "Vendor", "VendorController.php"),
    os.path.join(base_dir, "app", "Http", "Controllers", "BackEnd", "Property", "PropertyController.php")
]

views_dir = os.path.join(base_dir, "resources", "views")
for root, dirs, files in os.walk(views_dir):
    for f in files:
        if f.endswith(".blade.php"):
            process_file(os.path.join(root, f))

for c in controllers:
    process_file(c)

print("Codebase updated successfully!")
