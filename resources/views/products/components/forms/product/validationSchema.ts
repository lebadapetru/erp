import { boolean, number, object, string, array } from "yup";

const validationSchema = object().shape({
  title: string().trim().required('Title is required.'),
  description: string(),
  originalPrice: number()
    .nullable()
    .min(0)
    .transform((v) => (v === '' || Number.isNaN(v) ? null : v)),
  reducedPrice: number()
    .nullable()
    .min(0)
    .transform((v) => (v === '' || Number.isNaN(v) ? null : v)),
  discount: number()
    .nullable()
    .min(0)
    .max(100)
    .transform((v) => (v === '' || Number.isNaN(v) ? null : v)),
  sku: string().trim(),
  barcode: string().trim(),
  isTrackQuantity: boolean(),
  isContinueSellingOutOfStock: boolean(),
  quantity: number()
    .nullable()
    .integer()
    .min(0)
    .transform((v) => (v === '' || Number.isNaN(v) ? null : v)),
  isPhysicalProduct: boolean(),
  weight: number()
    .nullable()
    .min(0)
    .transform((v) => (v === '' || Number.isNaN(v) ? null : v)),
  file: array().of(
    object() //TODO maybe specify the .shape()
  )
});

export default validationSchema