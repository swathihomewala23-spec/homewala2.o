import os
import shutil

base_dir = r"d:\old_backend\backend\homewala-backend-pre-develop\homewala-backend-pre-develop"
assets_prop = os.path.join(base_dir, "public", "assets", "img", "property")
storage_pub = os.path.join(base_dir, "storage", "app", "public")

mappings = {
    "slider-images": "slider_images",
    "brochure": "brochures",
    "floor-plans": "floor_plans",
    "display_images": "display_images",
    "featureds": "featureds"
}

# 1. Move the folders
for old_name, new_name in mappings.items():
    old_path = os.path.join(assets_prop, old_name)
    new_path = os.path.join(storage_pub, new_name)
    
    if os.path.exists(old_path):
        os.makedirs(new_path, exist_ok=True)
        # Move all files
        for item in os.listdir(old_path):
            s = os.path.join(old_path, item)
            d = os.path.join(new_path, item)
            if not os.path.exists(d):
                shutil.copy2(s, d)
        print(f"Migrated {old_name} to {new_name}")

# Now, we should also fix the database for display_image and floor_plan_image if they contain absolute paths!
# But for now, let's just do a mass replace in the codebase for these paths.

def process_file(filepath):
    if not os.path.exists(filepath):
        return
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Replacements for string literals
    content = content.replace("assets/img/property/slider-images/", "storage/slider_images/")
    content = content.replace("assets/img/property/brochure/", "storage/brochures/")
    content = content.replace("assets/img/property/floor-plans/", "storage/floor_plans/")
    content = content.replace("assets/img/property/display_images/", "storage/display_images/")
    content = content.replace("assets/img/property/featureds/", "storage/featureds/")
    
    # Also for absolute server paths to public_path
    content = content.replace("public_path('assets/img/property/slider-images/')", "storage_path('app/public/slider_images/')")
    content = content.replace("public_path('assets/img/property/brochure/')", "storage_path('app/public/brochures/')")
    content = content.replace("public_path('assets/img/property/floor-plans/')", "storage_path('app/public/floor_plans/')")
    content = content.replace("public_path('assets/img/property/display_images/')", "storage_path('app/public/display_images/')")
    content = content.replace("public_path('assets/img/property/featureds/')", "storage_path('app/public/featureds/')")

    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)

# Process relevant files:
controllers = [
    os.path.join(base_dir, "app", "Http", "Controllers", "BackEnd", "Property", "PropertyController.php"),
    os.path.join(base_dir, "app", "Http", "Controllers", "Vendor", "PropertyController.php")
]

views_dir = os.path.join(base_dir, "resources", "views")
for root, dirs, files in os.walk(views_dir):
    for f in files:
        if f.endswith(".blade.php"):
            process_file(os.path.join(root, f))

for c in controllers:
    process_file(c)

# We also need to fix components
components_dir = os.path.join(views_dir, "components")
for root, dirs, files in os.walk(components_dir):
    for f in files:
        if f.endswith(".blade.php"):
            process_file(os.path.join(root, f))
            
print("Codebase updated successfully!")
