# 🦷 DentalCare - Admin Dashboard

لوحة تحكم احترافية لإدارة عيادة الأسنان، مصممة بتقنيات حديثة وسهلة الاستخدام.

## 📋 المميزات الرئيسية

### 1️⃣ إدارة المرضى
- ✅ عرض قائمة المرضى مع البحث والتصفية
- ✅ إضافة مريض جديد
- ✅ تعديل بيانات المريض
- ✅ عرض ملف المريض الكامل
- ✅ حفظ بيانات طبية إضافية (فئة الدم، الحساسيات)
- ✅ تصدير البيانات إلى CSV

### 2️⃣ إدارة المواعيد
- ✅ عرض المواعيد بصيغة قائمة أو تقويم
- ✅ إنشاء موعد جديد
- ✅ تعديل بيانات الموعد
- ✅ تغيير حالة الموعد (مؤكد، معلق، مكتمل، ملغي)
- ✅ تصفية حسب الطبيب والتاريخ والحالة

### 3️⃣ إدارة الطاقم الطبي
- ✅ إدارة الأطباء والممرضين
- ✅ إضافة موظف جديد
- ✅ تعديل بيانات الموظف
- ✅ تعيين جدول العمل الأسبوعي
- ✅ تتبع الحضور والغياب

### 4️⃣ لوحة التحكم الرئيسية
- ✅ ملخص إحصائيات مهمة
- ✅ مواعيد اليوم
- ✅ آخر المرضى المسجلين
- ✅ إجراءات سريعة

---

## 🛠️ البنية التقنية

### التكنولوجيا المستخدمة

| المكون | التقنية |
|--------|---------|
| **Frontend** | HTML5, CSS3, JavaScript (ES6+) |
| **Framework** | Bootstrap 5 RTL |
| **Backend** | Laravel 10+ |
| **Icons** | Font Awesome 6.4 |
| **تصميم** | Responsive Design (Mobile First) |

### هيكل الملفات

```
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php          # القالب الرئيسي
│   ├── dashboard/
│   │   └── index.blade.php        # الصفحة الرئيسية
│   ├── patients/
│   │   ├── index.blade.php        # قائمة المرضى
│   │   ├── create.blade.php       # إضافة مريض
│   │   ├── edit.blade.php         # تعديل المريض
│   │   └── show.blade.php         # ملف المريض
│   ├── appointments/
│   │   ├── index.blade.php        # قائمة المواعيد
│   │   ├── create.blade.php       # إنشاء موعد
│   │   ├── edit.blade.php         # تعديل الموعد
│   │   └── show.blade.php         # تفاصيل الموعد
│   ├── staff/
│   │   ├── index.blade.php        # قائمة الطاقم
│   │   ├── create.blade.php       # إضافة موظف
│   │   ├── edit.blade.php         # تعديل الموظف
│   │   └── schedule.blade.php     # جدول العمل
│   └── auth/
│       └── login.blade.php        # صفحة التسجيل
│
public/
├── css/
│   └── dashboard.css              # أنماط لوحة التحكم
├── js/
│   └── dashboard.js               # وظائف JavaScript
└── images/                         # الصور والأيقونات

routes/
└── web.php                        # مسارات التطبيق
```

---

## 🚀 البدء السريع

### المتطلبات
- PHP 8.1+
- Laravel 10+
- Composer
- Node.js (اختياري)

### التثبيت

1. **استنساخ المستودع**
```bash
git clone https://github.com/hala-dalloul/Test-Page.git
cd Test-Page
```

2. **تثبيت المكتبات**
```bash
composer install
npm install
```

3. **نسخ ملف البيئة**
```bash
cp .env.example .env
php artisan key:generate
```

4. **إعداد قاعدة البيانات**
```bash
php artisan migrate
php artisan db:seed
```

5. **تشغيل الخادم**
```bash
php artisan serve
```

6. **الدخول إلى الواجهة**
```
http://localhost:8000
```

---

## 📱 المميزات المتقدمة

### 🎨 التصميم Responsive
- يعمل بكفاءة على جميع الأجهزة (موبايل، تابلت، ديسكتوب)
- قائمة جانبية قابلة للطي على الشاشات الصغيرة
- جداول قابلة للتمرير على الموبايل

### 🔍 البحث والتصفية
- بحث فوري عن المرضى بالاسم أو الهاتف
- تصفية المواعيد حسب الطبيب والحالة والتاريخ
- تصفية الطاقم حسب الدور والحالة

### 📊 التقارير والتصدير
- تصدير البيانات إلى CSV
- طباعة الجداول مباشرة من المتصفح
- إحصائيات وتقارير مختلفة

### ⌨️ اختصارات لوحة المفاتيح
- يدعم الاختصارات السريعة للتنقل
- واجهة سهلة الاستخدام للإداريين

### 🔐 الأمان
- تحقق من بيانات الإدخال (Validation)
- حماية ضد هجمات CSRF
- تشفير كلمات المرور

---

## 📖 أمثلة الاستخدام

### إضافة مريض جديد

```html
<a href="{{ route('patients.create') }}" class="btn btn-primary">
    <i class="fas fa-user-plus me-2"></i>
    إضافة مريض جديد
</a>
```

### عرض قائمة المرضى

```html
@foreach($patients as $patient)
    <tr>
        <td>{{ $patient->name }}</td>
        <td>{{ $patient->phone }}</td>
        <td>{{ $patient->email }}</td>
        <td>
            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-sm btn-outline-info">
                <i class="fas fa-edit"></i>
            </a>
        </td>
    </tr>
@endforeach
```

### إنشاء موعد

```blade
{{ route('appointments.store') }}
```

---

## 🎯 المسارات الرئيسية (Routes)

| المسار | الوصف |
|--------|-------|
| `GET /` | الصفحة الرئيسية |
| `GET /patients` | قائمة المرضى |
| `POST /patients` | إضافة مريض |
| `GET /patients/{id}` | عرض ملف المريض |
| `PUT /patients/{id}` | تحديث بيانات المريض |
| `DELETE /patients/{id}` | حذف المريض |
| `GET /appointments` | قائمة المواعيد |
| `POST /appointments` | إنشاء موعد |
| `GET /staff` | قائمة الطاقم |
| `POST /staff` | إضافة موظف |
| `GET /staff/{id}/schedule` | جدول العمل |

---

## 🎨 خيارات التخصيص

### تغيير الألوان
عدل ملف `public/css/dashboard.css`:

```css
:root {
    --primary-color: #007bff;      /* اللون الأساسي */
    --secondary-color: #6c757d;    /* اللون الثانوي */
    --success-color: #28a745;      /* لون النجاح */
    --danger-color: #dc3545;       /* لون الخطأ */
}
```

### تغيير الخط
```css
body {
    font-family: 'Cairo', 'Segoe UI', sans-serif;
}
```

---

## 📞 الدعم والمساعدة

### المشاكل الشائعة

**المشكلة**: الصفحات لا تحمل بشكل صحيح
```bash
# الحل
php artisan cache:clear
php artisan config:clear
```

**المشكلة**: الأنماط لا تظهر
```bash
# أعد تجميع الموارد
npm run dev
```

---

## 📝 ملاحظات مهمة

1. **النسخ الاحتياطية**: قم بعمل نسخ احتياطية منتظمة من قاعدة البيانات
2. **التحديثات**: تحقق من التحديثات الأمنية بانتظام
3. **الأداء**: استخدم CDN للملفات الثابتة في الإنتاج
4. **HTTPS**: استخدم HTTPS دائماً في الإنتاج

---

## 🤝 المساهمة

نرحب بمساهماتك! يرجى اتباع الخطوات التالية:

1. Fork المستودع
2. أنشئ فرع جديد (`git checkout -b feature/AmazingFeature`)
3. Commit التغييرات (`git commit -m 'Add some AmazingFeature'`)
4. Push إلى الفرع (`git push origin feature/AmazingFeature`)
5. افتح Pull Request

---

## 📄 الترخيص

هذا المشروع مرخص تحت رخصة MIT - انظر ملف `LICENSE` للمزيد.

---

## 👨‍💻 المطورون

- **Hala M. Dalloul** - المطور الرئيسي

---

## 📞 التواصل

- البريد الإلكتروني: haladalloul42@gmail.com
- GitHub: [@hala-dalloul](https://github.com/hala-dalloul)

---

## 🗓️ سجل الإصدارات

### الإصدار 1.0.0 (2026-05-18)
- ✅ الإصدار الأول من لوحة التحكم
- ✅ إدارة المرضى
- ✅ إدارة المواعيد
- ✅ إدارة الطاقم الطبي

---

**آخر تحديث**: 18 مايو 2026
