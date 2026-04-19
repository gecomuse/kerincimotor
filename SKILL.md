# Skill: Kerinci Motor Article Publisher

Publish a complete article to kerincimotor.com via the OpenClaw API.
This skill handles thumbnail upload, article generation, and publishing in one flow.

## Inputs

| Input | Required | Description |
|-------|----------|-------------|
| `brief` | Yes | Topic or brief for the article |
| `image_path` | No | Local path to thumbnail image (from temp/workspace dir) |
| `image_url` | No | Public URL of thumbnail image (used if no local file) |
| `category` | No | One of: Panduan, Harga Pasar, Perbandingan, Kredit & DP, Rekomendasi, Tips Merawat, Berita (default: Panduan) |
| `status` | No | draft or published (default: published) |

## Environment Variables

| Variable | Description |
|----------|-------------|
| `WEBSITE_API_TOKEN` | Bearer token (`kerinci-motor-openclaw-2026`) |
| `WEBSITE_API_URL` | `https://kerincimotor.com/api/articles` |
| `WEBSITE_UPLOAD_URL` | `https://kerincimotor.com/api/upload-image` |

---

## Steps

### Step 1: Locate Thumbnail
Look for the image in OpenClaw's local temp/workspace directory.
- Do NOT re-download from Telegram — use what is already on disk.
- If `image_path` is provided and file exists → use it (go to Step 2).
- If only `image_url` is provided → skip to Step 3 (URL upload).
- If neither → skip thumbnail entirely, publish article without thumbnail (Step 5).

### Step 2: Upload Thumbnail via File
Use `curl.exe` — NEVER use `Invoke-WebRequest` for multipart uploads.

```powershell
$uploadResult = curl.exe -s -X POST "https://kerincimotor.com/api/upload-image" `
  -H "Authorization: Bearer kerinci-motor-openclaw-2026" `
  -F "image=@C:\path\to\image.jpg" `
  -F "type=thumbnail"

$uploadJson = $uploadResult | ConvertFrom-Json
```

If `$uploadJson.success` is `$true` → save `$thumbnailPath = $uploadJson.path`, go to Step 5.
If upload fails → log the error, continue to Step 5 without thumbnail.

### Step 3: Upload Thumbnail via URL
Use `curl.exe` for consistency.

```powershell
$uploadResult = curl.exe -s -X POST "https://kerincimotor.com/api/upload-image" `
  -H "Authorization: Bearer kerinci-motor-openclaw-2026" `
  -H "Content-Type: application/json" `
  -d "{\"image_url\": \"https://example.com/photo.jpg\", \"type\": \"thumbnail\"}"

$uploadJson = $uploadResult | ConvertFrom-Json
```

If `$uploadJson.success` is `$true` → save `$thumbnailPath = $uploadJson.path`, go to Step 5.
If upload fails → log the error, continue to Step 5 without thumbnail.

### Step 4: Parse Thumbnail URL
```powershell
$thumbnailPath = $uploadJson.path   # e.g. "posts/thumbnails/uuid.jpg"
$thumbnailUrl  = $uploadJson.url    # e.g. "https://kerincimotor.com/storage/posts/thumbnails/uuid.jpg"
```

### Step 5: Generate Article
Based on the user's brief, write a complete article with these fields:

| Field | Spec |
|-------|------|
| `title` | SEO-optimized, max 70 chars |
| `content` | 500–600 words, HTML using `<p>`, `<h2>`, `<h3>` tags only |
| `excerpt` | Max 300 chars, plain text (no HTML) |
| `meta_title` | Max 60 chars |
| `meta_description` | Max 160 chars |
| `meta_keywords` | 5–7 keywords, comma-separated |
| `category` | One of the 7 valid categories |

### Step 6: Publish Article
Use `ConvertTo-Json` to avoid escaping issues — NEVER build JSON manually as a string.

```powershell
$headers = @{
    "Authorization" = "Bearer kerinci-motor-openclaw-2026"
    "Content-Type"  = "application/json"
}

$body = @{
    title            = "[TITLE]"
    content          = "[HTML CONTENT]"
    excerpt          = "[EXCERPT]"
    meta_title       = "[META TITLE]"
    meta_description = "[META DESC]"
    meta_keywords    = "[KEYWORDS]"
    category         = "[CATEGORY]"
    thumbnail        = $thumbnailPath    # omit key if no thumbnail
    status           = "published"
} | ConvertTo-Json -Depth 3

$r = Invoke-RestMethod -Uri "https://kerincimotor.com/api/articles" `
    -Method POST -Headers $headers -Body $body
```

### Step 7: Report
Return a summary to the user:

```
Article URL : https://kerincimotor.com/artikel/[slug from $r.slug]
Thumbnail   : uploaded successfully  /  skipped (upload failed)
Time taken  : [X] seconds
```

---

## Rules

- **NEVER** use `Invoke-WebRequest` for multipart/file uploads — always use `curl.exe`.
- **ALWAYS** use `ConvertTo-Json` for article publishing — never a manual JSON string.
- If thumbnail upload fails, publish the article anyway without the thumbnail field.
- Find images from OpenClaw's local temp/workspace directory, not re-downloaded from Telegram.
- Always end by reporting the live article URL to the user.
